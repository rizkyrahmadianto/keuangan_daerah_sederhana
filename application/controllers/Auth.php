<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
	}

	public function index()
	{
		$info['title'] = 'Log In';

		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header_auth', $info);
			$this->load->view('auth/login');
			$this->load->view('template/footer_auth');
		} else {
			$this->_login();
		}

		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role_id') == 1) {
				redirect('admin', 'refresh');
			} else {
				redirect('user', 'refresh');
			}
		}
	}

	private function _login()
	{
		$email = $this->input->post('email', true);
		$pass  = $this->security->xss_clean(html_escape($this->input->post('password', true)));

		$user  = $this->Auth_model->userLogin($email);

		if ($user) {
			if ($user['is_active'] == 1) {
				if (password_verify($pass, $user['password'])) {
					$file = [
						'email'     => $this->security->xss_clean(html_escape($user['email'])),
						'role_id'   => $this->security->xss_clean(html_escape($user['role_id']))
					];

					$this->session->set_userdata($file);

					// COOKIE
					$cookie = array(
						'name' => "CookieKeaunganDaerah",
						'value'  => $email,
            'expire' =>  86500,
            'secure' => FALSE
					);

					if ($this->input->post('customCheck')) {
						$this->input->set_cookie($cookie);
					}

					if ($user['role_id'] == 1) {
						redirect('admin', 'refresh');
					} else {
						redirect('user', 'refresh');
					}
				} else {
					$this->session->set_flashdata('error', 'Wrong password !');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('error', 'Your email has not been activated!');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('error', 'Your email has not registered!');
			redirect('auth');
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' 	=> 'smtp',
			'smtp_host'	=> 'ssl://smtp.googlemail.com',
			'smtp_user'	=> 'your@email.com',
			'smtp_pass'	=> 'password',
			'smtp_port'	=> 465,
			'mailtype'	=> 'html',
			'charset'	=> 'utf-8',
			'newline'	=> "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('your@email.com', 'Keuangan Daerah Admin');
		$this->email->to($this->input->post('email', true));
		/*$this->email->cc('another@example.com');
        $this->email->bcc('and@another.com');*/

		if ($type == 'activate') {
			$this->email->subject('Activate Account');
			$this->email->message('Click this link to activate your account :
        		<a href="' . base_url() . 'auth/activate?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate Now</a>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password :
        		<a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Now</a>');
		}

		if ($this->email->send()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function register()
	{
		$info['title'] = "Regsiter Page";

		$this->form_validation->set_rules('name', 'full name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[users.email]', ['is_unique' => 'This email has already registered !']);
		$this->form_validation->set_rules('password1', 'password', 'trim|required|min_length[6]|matches[password2]');
		$this->form_validation->set_rules('password2', 'repeat password', 'trim|required|min_length[6]|matches[password2]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header_auth', $info);
			$this->load->view('auth/register');
			$this->load->view('template/footer_auth');
		} else {
			$email = $this->security->xss_clean($this->input->post('email', true));

			$file = [
				'name' 			=> $this->security->xss_clean(htmlspecialchars($this->input->post('name', true))),
				'email'			=> htmlspecialchars($email),
				'image'			=> 'default.jpg',
				'password'		=> password_hash($this->security->xss_clean(html_escape($this->input->post('password1', true))), PASSWORD_DEFAULT),
				'role_id'		=> 2,
				'is_active'		=> 0,
				'created_at'	=> time()
			];

			/*TOKEN*/
			$token 		= base64_encode(random_bytes(32));
			$user_token	= [
				'email' 		=> $email,
				'token'			=> $token,
				'created_at'	=> time()
			];

			$this->Auth_model->insertToRegister($file);
			$this->Auth_model->insertToken($user_token);

			$this->_sendEmail($token, 'activate');

			$this->session->set_flashdata('success', 'Your account has been created !. Please check your email and activate your account !');
			redirect('auth', 'refresh');
		}

		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role_id') == 1) {
				redirect('admin', 'refresh');
			} else {
				redirect('user', 'refresh');
			}
		}
	}

	public function activate()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user  = $this->db->get_where('users', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['created_at'] < (60 * 60 + 24)) {
					$this->Auth_model->updateUser($email);
					$this->Auth_model->deleteUserToken($email);
					$this->session->set_flashdata('success', $email . ' has been activated. Please login !');
					redirect('auth', 'refresh');
				} else {
					$this->Auth_model->deleteUserToken($email);
					$this->Auth_model->deleteUser($email);
					$this->session->set_flashdata('error', 'account activation failed ! Token expired.');
					redirect('auth', 'refresh');
				}
			} else {
				$this->session->set_flashdata('error', 'account activation failed ! Wrong token.');
				redirect('auth', 'refresh');
			}
		} else {
			$this->session->set_flashdata('error', 'account activation failed ! Wrong email.');
			redirect('auth', 'refresh');
		}
	}

	public function forgotPassword()
	{
		$info['title'] = 'Forgot Password';

		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header_auth', $info);
			$this->load->view('auth/forgot_pass');
			$this->load->view('template/footer_auth');
		} else {
			$data = [
				'email'     => $this->security->xss_clean(html_escape($this->input->post('email', true))),
				'is_active' => 1
			];

			if ($this->Auth_model->checkUserEmail($data)) {
				$token = base64_encode(random_bytes(32));

				$user_token = [
					'email'         => $this->security->xss_clean(html_escape($this->input->post('email', true))),
					'token'         => $token,
					'created_at'    => time()
				];

				$this->Auth_model->insertChangePass($user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('success', 'please check your email to reset your password !');
				redirect('auth/forgotpassword', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'email is not registered or activated !');
				redirect('auth/forgotpassword', 'refresh');
			}
		}
	}

	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		if ($this->db->get_where('users', ['email' => $email])->row_array()) {
			if ($this->db->get_where('user_token', ['token' => $token])->row_array()) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('error', 'reset password failed, wrong token.');
				redirect('auth', 'refresh');
			}
		} else {
			$this->session->set_flashdata('error', 'reset password failed, wrong email.');
			redirect('auth', 'refresh');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth', 'refresh');
		}

		$info['title'] = "Change Password";

		$this->form_validation->set_rules('pass', 'new password', 'trim|required|min_length[6]|matches[repeat_pass]');
		$this->form_validation->set_rules('repeat_pass', 'repeat new password', 'trim|required|min_length[6]|matches[pass]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header_auth', $info);
			$this->load->view('auth/change_pass');
			$this->load->view('template/footer_auth');
		} else {
			$password 	= $this->security->xss_clean(html_escape($this->input->post('pass', true)));
			$hash_pass	= password_hash($password, PASSWORD_DEFAULT);
			$email 		= $this->session->userdata('reset_email');

			$this->Auth_model->updateUserPass($hash_pass, $email);
			$this->Auth_model->deleteUserToken($email);

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('success', $email . ' password has been changed. Please login !');
			redirect('auth', 'refresh');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$cookie = array(
			'name' => 'CookieKeaunganDaerah',
			'value' => '',
			'expire' => 0,
		);

		delete_cookie($cookie);

		$this->session->set_flashdata('success', 'You have been logout !');
		redirect('auth', 'refresh');
	}

	public function denied()
	{
		$info['title']	= "Oops! Access Denied";
		$this->load->view('template/header', $info);
		$this->load->view('auth/denied');
	}
}
