<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * The Message library (originally based on http://codeigniter.com/wiki/Message/)
 * is a fairly straightforward Codeigniter library that makes it easier
 * to set different type of mensagens such as errors and notifications. Traditionally you'd
 * use $this->session->set_flashdata() but this can result in a lot of code for something
 * so simple. The Message library in many ways works similar to the session library but is
 * meant to be easier to use and reduce the amount of code.
 *
 * A basic example of using the Message library looks like the following (this should be
 * executed in a controller):
 *
 *   $this->load->library('mensagem');
 *   $this->mensagem->set('info', 'Hello, world!');
 *
 * I've skipped the configuration part (for now) but as you can see it only takes 2 lines
 * of code to set a mensagem. Retrieving this mensagem is quite easy too and looks like the
 * following (this goes into a view):
 *
 *   <?php if ( $this->mensagem->display() ) { echo $this->mensagem->display(); } ?>
 *
 * For more information you should check the README.
 *
 * @author  Jeroen vd. Gulik, Isset Internet Professionals
 * @link    http://isset.nl/
 * @package Message Library
 * @version 1.2
 * @license MIT License
 *
 * Copyright (C) 2010 - 2011, Isset Internet Professionals
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
class Mensagem
{
	/**
	 * Variable containing a reference to the Codeigniter instance.
	 *
	 * @access private
	 * @var    object
	 */
	private $CI;

	/**
	 * Array containing all mensagens that were set using the set() method.
	 *
	 * @access private
	 * @var    array
	 */
	private $mensagens = array();

	/**
	 * Prefix to use for all mensagens.
	 *
	 * @access private
	 * @var    string
	 */
	private $mensagem_prefix	= '';

	/**
	 * Suffix to use for all mensagens.
	 *
	 * @access private
	 * @var    string
	 */
	private $mensagem_suffix	= '';

	/**
	 * The directory in which all mensagens are stored.
	 *
	 * @access private
	 * @var    string
	 */
	private $mensagem_folder	= '';

	/**
	 * The view for the current mensagem.
	 *
	 * @access private
	 * @var    string
	 */
	private $mensagem_view	= '';

	/**
	 * The prefix for the mensagens container.
	 *
	 * @access private
	 * @var    string
	 */
	private $wrapper_prefix	= '';

	/**
	 * The suffix for the mensagens container.
	 *
	 * @access private
	 * @var    string
	 */
	private $wrapper_suffix	= '';

	/**
	 * Constructor method, called whenever the library is loaded using $this->load->library()
	 *
	 * @access	public
	 * @param   array $config Associative array containing all configuration options.
	 * @return  object
	 */
	public function __construct($config = array())
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');

		if ($this->CI->session->userdata('_mensagens'))
		{
			$this->mensagens = $this->CI->session->userdata('_mensagens');
		}

		if ( count($config) > 0 )
		{
			$this->initialize($config);
		}

		log_message('debug', "Message Class Initialized");
	}

	/**
	 * Initializes the library by setting all custom configuration options based
	 * on the specified array.
	 *
	 * @example
	 *  $this->load->library('mensagem');
	 *  $this->mensagem->initialize(array(
	 *      'wrapper_prefix' => 'container_'
	 *  ));
	 *
	 * @access public
	 * @param  array $config Associative array containing all user-defined configuration options.
	 * @return void
	 */
	public function initialize($config = array())
	{
		foreach ( $config as $key => $val )
		{
			if ( isset($this->$key) )
			{
				$this->$key = $val;
			}
		}
	}

	/**
	 * Adds a new mensagem to the internal storage. The first argument is either a string
	 * or an array of mensagem groups (e.g. "error" or "info") and the second argument
	 * a value for each of these mensagens. If the first argument is set as an array
	 * the second argument will be ignored.
	 *
	 * @example
	 *  $this->mensagem->set('error', 'Bummer! Somebody sat on the tubes!');
	 *  $this->mensagem->set(array(
	 *    'error' => 'Woops, seems something is broken!',
	 *    'info'  => 'Hello, world!' 
	 *  ));
	 *
	 * @access	public
	 * @param	array/string $groups Either a string containing the group name or an
	 * array of key/value combinations of each group and it's value.
	 * @param	string $mensagem The mensagem to display whenever the first argument
	 * was a string.
	 * @return	void
	 */
	public function set($groups, $mensagem = NULL)
	{
		if ( is_string($groups) )
		{
			$groups = array($groups => $mensagem);
		}

		if ( count($groups) > 0 )
		{
			foreach ( $groups as $group => $value )
			{
				// Let's skip empty mensagens
				if ( empty($value) )
				{
					continue;
				}

				// Technically not always required but it ensures the group is always there.
				if ( !isset($this->mensagens[$group]) )
				{
					$this->mensagens[$group] = array();
				}
				
				$this->mensagens[$group][] = $value;
			}

			$this->CI->session->set_userdata('_mensagens', $this->mensagens);
		}
	}

	/**
	 * Fetches all mensagens for the specified group. If no group was found this
	 * method will return FALSE instead of an array.
	 *
	 * @example
	 *  $this->library->get('error');
	 *
	 * @access	public
	 * @param	string $group The name of the group you want to retrieve.
	 * @return	array/boolean
	 */
	public function get($group = FALSE)
	{
		// Do we have something to show?
		if ( count($this->mensagens) == 0 )
		{
			return FALSE;
		}

		// If a group is specified we'll return it, otherwise we'll return all items
		if ( isset($group) AND !empty($group) )
		{
			if ( isset($this->mensagens[$group]) )
			{
				return $this->mensagens[$group];
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return $this->mensagens;
		}
	}

	/**
	 * Retrieves all mensagens and formats them using the corresponding views for each mensagem.
	 * If you want to return the raw mensagens use the get() method instead.
	 *
	 * @example
	 *  echo $this->mensagem->display('error');
	 *
	 * @access	public
	 * @param	string $group The name of the group you want to output.
	 * @return	string
	 */
	public function display($group = FALSE)
	{
		// do we have something to show?
		if ( $this->get($group) === FALSE) 
		{
			return FALSE;
		}

		// Let's format the data
		$output = $this->format_output($group);

		// Clear our mensagem cache
		$this->CI->session->unset_userdata('_mensagens');

		return $output;
	}

	/**
	 * Formats a group of mensagens based on the corresponding view.
	 *
	 * @access	private
	 * @param	string $by_group The name of the group to format.
	 * @return	string
	 */
	private function format_output($by_group = FALSE)
	{
		$output = NULL;

		// loop through the groups and cascade through format options
		foreach ( $this->mensagens as $group => $mensagens )
		{
			// was a group set? if so skip all groups that do not match
			if ( $by_group !== FALSE && $group != $by_group )
			{
				continue;
			}

			// does a view partial exist?
			if ( file_exists(APPPATH.'views/'.$this->mensagem_folder.$group.'_view' . EXT) )
			{
				$output .= $this->CI->load->view($this->mensagem_folder.$group.'_view', array('mensagens'=>$mensagens), TRUE);
			}
			// does a default view partial exist?
			elseif ( file_exists(APPPATH.'views/'.$this->mensagem_folder.$this->mensagem_view.'_view' . EXT) )
			{
				$output .= $this->CI->load->view($this->mensagem_folder.$this->mensagem_view.'_view', array('mensagens'=>$mensagens), TRUE);
			}
			// fallback to default values (possibly set by config)
			else
			{
				$output .= $this->wrapper_prefix . PHP_EOL;

				foreach ( $mensagens as $msg )
				{
					$output .= $this->mensagem_prefix . $msg . $this->mensagem_suffix . PHP_EOL;
				}

				$output .= $this->wrapper_suffix . PHP_EOL;
			}
		}

		return $output;
	}
}

/* End of file Message.php */
/* Location: ./application/libraries/Message.php */
