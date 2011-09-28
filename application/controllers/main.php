<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in ap
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->data['loggedin'] = $this->session->userdata('logged_in');
		$this->data['seoTitle'] = "dcmntr- Feedback, Discussion, Relationships";
	}
	
	public function login_failed()
	{
		$this->load->view('header', $this->data);
		$this->load->view('login_failed', $this->data);
		$this->load->view('footer');
	}
	
	public function index()
	{
		$this->data['seoCanonical'] = site_url("");
		$this->data['home_page'] = TRUE;
		$this->db->order_by("id", "random");
		$randomApp =  $this->db->get("app", 1)->row();
		$this->data['randomApp'] = $randomApp;
		
		$this->data['user'] = $this->db->get_where("users", array("id" => $randomApp->devid))->row();
		
		
		$this->load->view('header', $this->data);
		$this->load->view('home', $this->data);
		$this->load->view('footer');
	}
	
	public function apps()
	{
		$this->load->helper('text');

		$this->data['app_page'] = TRUE;
		
		$this->db->order_by("datecreated", "DESC");
		$newest_apps = $this->db->get("app", 50, 0)->result();
		$this->data['newest_apps'] = $newest_apps;
		
		$this->db->order_by("createdate", "DESC");
		$latest_discussion = $this->db->get_where("discussion", array('parentid' => 0), 50, 0)->result();
		$this->data['latest_discussion'] = $latest_discussion;
		
		$this->db->order_by("timestamp", "DESC");
		$latest_bug = $this->db->get_where("bug", array('parentid' => 0), 50, 0)->result();
		$this->data['latest_bug'] = $latest_bug;
		
		$this->load->view('header', $this->data);
		$this->load->view('app', $this->data);
		$this->load->view('footer', $this->data);
	}
	
	public function index2()
	{
		
		$this->db->order_by("datecreated", "desc");
		$users = $this->db->get("users", 50, 0);
		$users = $users->result();
		
		$this->data['apps'] = $apps;
		$this->data['users'] = $users;
		
		if($this->data['loggedin'])
		{
			$userinfo = $this->db->get_where('users', array("id" =>$this->session->userdata('userid')));
			
			$userinfo = $userinfo->row();
			
			$this->data['name'] = $userinfo->name;
			$this->data['email'] = $userinfo->email;
			$this->data['url'] = $userinfo->url;
		
			$userapps = $this->db->get_where("app", array("devid" => $this->session->userdata('userid')));
			
			$userapps = $userapps->result();
			
			$this->data['userapps'] = $userapps;
		}
				
		$this->load->view('header', $this->data);
		$this->load->view('home', $this->data);
		$this->load->view('footer');
	}
	
	public function login()
	{
		if($this->input->post() && $this->input->post('email') != '' && $this->input->post('password') != '')
		{
			$data = array(
						"email" => $this->input->post("email"),
						"password" => sha1($this->input->post("password")));
			$query = $this->db->get_where("users", $data, 1);
			if($query->num_rows() > 0)
			{
				$query = $query->row();
				$userdata = array(
								"userid" => $query->id,
								"logged_in" => TRUE);
				$this->session->set_userdata($userdata);
				redirect('profile');
			}
		}
		redirect('login-failed');
	}
	
	public function profile()
	{
		if($this->session->userdata('logged_in'))
		{
			$user = $this->db->get_where("users", array("id" => $this->session->userdata('userid')))->row();
			
			$apps = $this->db->get_where("app", array("devid" => $this->session->userdata('userid')))->result();
			
			$this->data['user'] = $user;
			$this->data['apps'] = $apps;
			$this->load->view("header", $this->data);
			$this->load->view("my_profile", $this->data);
			$this->load->view("footer", $this->data);
		}
	}
	
	public function sign_up()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4])');
		
		if($this->form_validation->run() == TRUE)
		{
			$checkemail = $this->db->get_where("users", array("email" => $this->input->post("email")));
			
			if($checkemail->num_rows() > 0)
			{
				redirect("main");
			}
		
			$data = array(
						'email' => $this->input->post('email'),
						'password' => sha1($this->input->post('password')));
			$this->db->insert('users', $data);
			
			$search = array('email' => $this->input->post('email'));
			
			$query = $this->db->get_where('users', $search, 1);
						
			if($query->row())
			{
				$query = $query->row();			
							
				$sessiondata = array(
								'userid' => $query->id,
								'logged_in' => TRUE);
				
				$this->session->set_userdata($sessiondata);
				
				redirect('welcome');
			}
		}
		
		$this->load->view('header', $this->data);
		$this->load->view('sign_up', $this->data);
		$this->load->view('footer', $this->data);
	}
	
	public function welcome()
	{
		if($this->session->userdata('logged_in')){
			if($_POST)
			{
				$adddata = array('name' => $this->input->post('username'));
				$this->db->where('id', $this->session->userdata('userid'));
				$this->db->update('users', $adddata);
				
				if($this->input->post('addapp') == true)
				{
					redirect('add-app');
				}else
				{
					redirect('home');
				}
			}else
			{
		$this->load->view("header", $this->data);
			$this->data['id'] = $this->session->userdata('userid');
			$this->load->view('welcome', $this->data);
			$this->load->view('footer');
			}
		}
	}
	
	public function add_app()
	{
	$this->data['edited'] = FALSE;
		if($this->session->userdata('logged_in'))
		{
			if($_POST && ($this->input->post("appname") != ''))
			{
				$data = array(
							"appname" => $this->input->post("appname"),
							"email" => $this->input->post("email"),
							"devid" => $this->session->userdata("userid"),
							"url" => $this->input->post("url"),
							"description" => $this->input->post("description"),
							"appnameid" => strtolower(str_replace(" ", '', $this->input->post("appname")))
							);
				$this->db->insert('app', $data);
				
				redirect('profile');
			}else{
			$this->db->where('id', $this->session->userdata('userid'));
			$query = $this->db->get('users');
			$query = $query->row();
							
			$this->data['url'] = $query->url;
			$this->data['edit'] = false;
			$this->data['email'] = $query->email;
			
			$this->load->view("header", $this->data);
			$this->load->view('add_app', $this->data);
			$this->load->view('footer');
			}
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}
	
	public function edit_user()
	{
	if($this->session->userdata('logged_in'))
	{
		if($_POST)
		{
			$userdata = $this->db->get_where('users', array('id' => $this->session->userdata('userid')));
			
			$userdata = $userdata->row();
		
			$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'url' => $this->input->post('url'));
			if(sha1($this->input->post('oldpw')) == $userdata->password && ($this->input->post('newpw') == $this->input->post('newpwagain')))
			{
				$data['password'] = sha1($this->input->post('newpw'));
			}
			$this->db->where("id", $this->session->userdata("userid"));
			$this->db->update('users', $data);
		}
		redirect('profile');
	}
	}
	
	public function user_profile($var)
	{
		$userquery = $this->db->get_where("users", array("id" => $var));
		
		
		if($userquery->num_rows() > 0)
		{
			$userquery = $userquery->row();
		
			$this->data['name'] = $userquery->name;
			$this->data['email'] = $userquery->email;
			$this->data['user_website'] = prep_url($userquery->url);
			$this->data['user_page'] = TRUE;
			$this->data['seoTitle'] = "$userquery->name's User Profile | dcmntr";
			$this->data['seoCanonical'] = site_url("user-profile/$userquery->id/" . url_title($userquery->name, 'dash', TRUE));
			$apps = $this->db->get_where('app', array('devid' => $var));
			$apps = $apps->result();
			$this->data['apps'] = $apps;
			$this->load->view('header', $this->data);
			$this->load->view('user_profile', $this->data);
			$this->load->view('footer');
		}else
		{
			redirect("/home");
		}
	}
	
	public function app_profile($var, $subpage = 'discussion')
	{
	$this->load->helper('inflector');

		$this->data['app_page'] = TRUE;
		$query = $this->db->get_where('app', array('appnameid' => $var));
		
		if($query->result() > 0)
		{
			$query = $query->row();
			$this->db->order_by("createdate", "DESC");
			$discussion = $this->db->get_where("discussion", array("appid" => $query->id, "parentid" => 0));
			$discussion = $discussion->result();
			
			$this->db->order_by("timestamp", "DESC");
			$bug = $this->db->get_where("bug", array("appid" => $query->id, "parentid" => 0));
			$bug = $bug->result();
			
			$faq = $this->db->get_where("faqs", array("appid" => $query->id))->result();
			
			$user = $this->db->get_where("users", array("id" => $query->devid))->row();
			
			$this->data['appname'] = $query->appname;
			$this->data['appemail'] = $query->email;
			$this->data['appnameid'] = $var;
			$this->data['isdev'] = ($this->session->userdata('userid') == $query->devid) ? TRUE : FALSE;
			$this->data['appemail'] = $query->email;
			$this->data['appurl'] = $query->url;
			$this->data['dev'] = $user;
			$this->data['discussions'] = $discussion;
			$this->data['bugs'] = $bug;
			$this->data['faq'] = $faq;
			$this->data['appdescription'] = $query->description;
			$this->data['seoTitle'] = "$query->appname Application " . humanize($subpage) . " | dcmntr";
			$this->data['subpage'] = $subpage;
			$this->load->view("header", $this->data);
			$this->load->view("app_profile", $this->data);
			$this->load->view("footer");
		}
	}
	
	public function edit_app($var)
	{
	$this->data['edited'] = FALSE;
	if($this->session->userdata('logged_in'))
		{
			if($_POST)
			{
				$data = array(
							"appname" => $this->input->post("appname"),
							"email" => $this->input->post("email"),
							"devid" => $this->session->userdata("userid"),
							"url" => $this->input->post("url"),
							"description" => $this->input->post("description"),
							"appnameid" => strtolower(str_replace(" ", '', $this->input->post("appname")))
							);
							
				$appwhere = array("id" => $var,
									"devid" => $this->session->userdata('userid'));
				$this->db->where($appwhere);
				$this->db->update('app', $data);
				
				$this->data['edited'] = TRUE;
				
			}
			$this->db->where('id', $var);
			$query = $this->db->get('app');
			$query = $query->row();
			
			$this->data["appname"] = $query->appname;
			$this->data['email'] = $query->email;
			$this->data['url'] = $query->url;
			$this->data['description'] = $query->description;
			$this->data['id'] = $var;
			$this->data['edit'] = TRUE;
			
			$this->load->view("header", $this->data);
			$this->load->view('add_app', $this->data);
			$this->load->view('footer');
		}
	}
	
	public function delete_app($var)
	{
	if($this->session->userdata('logged_in'))
		{
			$delwhere = array("id" => $var,
								"devid" => $this->session->userdata('userid'));
			$this->db->where($delwhere);
			$this->db->delete("app");
			
			redirect("profile");
		}
	}
	
public function add_topic($var)
	{
	if($this->session->userdata('logged_in'))
		{
			if($_POST && ($this->input->post("title") != '' && $this->input->post("body") != ""))
			{
				$app = $this->db->get_where("app", array("appnameid" => $var));
				$app = $app->row();
				
				$data = array("title" => $this->input->post("title"),
								"body" => $this->input->post('body'),
								"parentid" => 0,
								"appid" => $app->id,
								"userid" => $this->session->userdata('userid'));
				
				$this->db->insert("discussion", $data);
				redirect('app-profile/' . $var);
			}else
			{
				$app = $this->db->get_where("app", array("appnameid" => $var));
				$app = $app->row();
				
				$this->data["appname"] = $app->appname;
				$this->load->view("header", $this->data);
				$this->load->view('add_topic', $this->data);
				$this->load->view('footer');
			}
		}
	}
	
	public function view_discussion($id, $appnameid)
	{
		if($_POST)
		{
			$app = $this->db->get_where("app", array("appnameid" => $appnameid));
			$app = $app->row();
			$data = array("body" => $this->input->post("comment"),
							"parentid" => $id,
							"appid" => $app->id,
							"userid" => $this->session->userdata('userid'));
			$this->db->insert("discussion", $data);
		}
	
		$discussion = $this->db->get_where("discussion", array("id" => $id));
		
		$discussion = $discussion->row();
		
		$this->data['discussion'] = $discussion;
		
		$this->data['app'] = $this->db->get_where("app", array("id" => $discussion->appid))->row();
		$this->data['dev'] = $this->db->get_where("users", array("id" => $this->data['app']->devid))->row();
	
		$this->data['seoTitle'] = "$discussion->title - " . $this->data['app']->appname . " | dcmntr";
		$this->data['seoCanonical'] = site_url("view-discussion/" . $this->data['app']->appname . "/" . $discussion->id . "/" . url_title($discussion->title, 'dash', TRUE));
		$this->load->view('header', $this->data);
		$this->load->view('view_discussion', $this->data);
		$this->load->view('footer');
	}
	
public function add_bug($var)
	{
	if($this->session->userdata('logged_in'))
		{
			if($_POST && ($this->input->post("title") != '' && $this->input->post("body") != ""))
			{
				$app = $this->db->get_where("app", array("appnameid" => $var));
				$app = $app->row();
				
				$data = array("title" => $this->input->post("title"),
								"body" => $this->input->post('body'),
								"parentid" => 0,
								"appid" => $app->id,
								"userid" => $this->session->userdata('userid'));
				
				$this->db->insert("bug", $data);
				redirect('app-profile/' . $var . "/bugs");
			}else
			{
				$app = $this->db->get_where("app", array("appnameid" => $var));
				$app = $app->row();
				
				$this->data["appname"] = $app->appname;
			
				$this->load->view("header", $this->data);
				$this->load->view('add_bug', $this->data);
				$this->load->view('footer');
			}
		}
	}
	
	public function view_bug($id, $appnameid)
	{
		if($_POST)
		{
			$app = $this->db->get_where("app", array("appnameid" => $appnameid));
			$app = $app->row();
			$data = array("body" => $this->input->post("comment"),
							"parentid" => $id,
							"appid" => $app->id,
							"userid" => $this->session->userdata('userid'));
			$this->db->insert("bug", $data);
		}
	
		$bug = $this->db->get_where("bug", array("id" => $id));
		
		$bug = $bug->row();
		
		$this->data['bug'] = $bug;

		$this->data['app'] = $this->db->get_where("app", array("id" => $bug->appid))->row();
		$this->data['dev'] = $this->db->get_where("users", array("id" => $this->data['app']->devid))->row();

		$this->data['seoTitle'] = "$bug->title - " . $this->data['app']->appname . " | dcmntr";
		$this->data['seoCanonical'] = site_url("view-discussion/" . $this->data['app']->appname . "/" . $bug->id . "/" . url_title($bug->title, 'dash', TRUE));
		
		$this->load->view('header', $this->data);
		$this->load->view('view_bug', $this->data);
		$this->load->view('footer');
	}
	
	public function view_faq($id, $appnameid)
	{
		$faq = $this->db->get_where("faqs", array('id' => $id))->row();
		
		$this->data['faq'] = $faq;

		
		$this->data['app'] = $this->db->get_where("app", array("id" => $faq->appid))->row();
		$this->data['dev'] = $this->db->get_where("users", array("id" => $this->data['app']->devid))->row();

		$this->data['seoTitle'] = "$faq->question - " . $this->data['app']->appname . " | dcmntr";
		$this->data['seoCanonical'] = site_url("view-faq/" . $this->data['app']->appnameid . "/" . $faq->id . "/" . url_title($faq->question, 'dash', TRUE));		
		
		$this->load->view('header', $this->data);
		$this->load->view('view_faq', $this->data);
		$this->load->view('footer');
	}
	
	public function add_faq($appnameid)
	{
	$app = $this->db->get_where("app", array('appnameid' => $appnameid))->row();
	if($this->session->userdata('logged_in') && ($this->session->userdata('userid') == $app->devid))
	{
		if($_POST)
		{
			$data['question'] = $this->input->post("question");
			$data['answer'] = $this->input->post("answer");
			$data['appid'] = $app->id;
			
			$this->db->insert("faqs", $data);
			redirect("app-profile/$appnameid/faqs");
		}
		
		$this->load->view('header', $this->data);
		$this->load->view('add_faq', $this->data);
		$this->load->view('footer');
		}
	}
	
	public function edit_faq($faqid, $appnameid)
	{
		$faq = $this->db->get_where("faqs", array('id' => $faqid))->row();
		$app = $this->db->get_where("app", array('id' => $faq->appid))->row();
		if($this->session->userdata('userid') == $app->devid)
		{
			if($this->input->post())
			{
				$faqdata = array("question" => $this->input->post("question"),
								"answer" => $this->input->post("answer"));
				
				$this->db->where("id", $faqid);
				$this->db->update("faqs", $faqdata);
				$this->data['edited'] = TRUE;
			}
			$this->load->view('header', $this->data);
			$this->data['appnameid'] = $app->appnameid;
			$this->data['faq'] = $faq;
			$this->load->view('edit_faq', $this->data);
			$this->load->view('footer');
		}
		else
			redirect('home');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */