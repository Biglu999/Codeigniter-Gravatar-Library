<?php
/**
 * Codeigniter Gravatar Library
 *
 * Zjištění URL adresy k obrázku gravataru z emailové adresy
 *
 * @package	Codeigniter
 * @subpackage Libraries
 * @author	BigLu
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @since	Version 1.0
 * @filesource
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Gravatar library
 *
 * Zjištění URL adresy k obrázku gravataru z emailové adresy
 */
class Gravatar{

	/**
	 * Emailová adresa uživatele
	 *
	 * @var string
	 */
	protected $email;

	/**
	 * URL první část URL adresy ke Gravataru
	 *
	 * @var string
	 */
	protected $gravatar_url      = 'https://secure.gravatar.com/avatar/';

	/**
	 * Výchozí velikost obrázku gravataru (v px.)
	 *
	 * @var int
	 */
	protected $gravatar_size     = 80;

	/**
	 * Typ zobrazeného obrázku pokud není nahrán jiný
	 * (404, mm, identicon, monsterid, wavatar)
	 *
	 * @var string
	 */
	protected $gravatar_type     = 'monsterid';

	/**
	 * Výchozí hodnocení pro zobrazený obrázek
	 * (g, pg, r, x)
	 *
	 * @var string
	 */
	protected $gravatar_rating   = 'g';

	// ---------------------------------------------------------------------------------------------

	/**
	 * Inicializace třídy
	 *
	 * @return	void
	 */
	public function __construct( $email = false ){
		if( $email != false ){
			if( $this->_check_email( $this->_prepare_string( $email ))){
				$this->email = $this->_prepare_string( $email );
			}
		}
	}

	// ---------------------------------------------------------------------------------------------

	/**
	 * Nastavení emailové adresy
	 *
	 * @param string Emailová adresa
	 * @return bool
	 */
	public function set_email( $email ){
		if( $this->_check_email( $this->_prepare_string( $email ))){
			$this->email = $this->_prepare_string( $email );
			return true;
		}
		return false;
	}

	// ---------------------------------------------------------------------------------------------

	/**
	 * Nastavení velikosti zobrazeného gravataru
	 *
	 * (max 2048px)
	 *
	 * @param int Velikost gravataru v pixelech
	 * @return bool
	 */
	public function set_size( $size ){
		if( !is_numeric( $size )){
			return false;
		}else{
			if( $size > 2048 ) $size = 2048;
			$this->gravatar_size = $size;
			return true;
		}
		return false;
	}

	// ---------------------------------------------------------------------------------------------

	/**
	 * Nastavení typu gravataru pokud nemá uživatel nastaven obrázek
	 *
	 * (404, mm, identicon, monsterid, wavatar)
	 *
	 * @param string Typ výchozího gravataru (404, mm, identicon, monsterid, wavatar)
	 * @return bool
	 */
	public function set_type( $type ){
		if( !is_string( $type )){
			return false;
		}else{
			if( !in_array( $this->_prepare_string( $type ), array( '404', 'mm', 'identicon', 'monsterid', 'wavatar' ))){
				return false;
			}else{
				$this->gravatar_type = $this->_prepare_string( $type );
				return true;
			}
		}
	}

	// ---------------------------------------------------------------------------------------------

	/**
	 * Nastavení hodnocení uživatelem nahraného obrázku
	 *
	 * (g, pg, r, x)
	 *
	 * @param string Hodnocení (g, pg, r, x)
	 * @return bool
	 */
	public function set_rating( $rating ){
		if( !is_string( $rating )){
			return false;
		}else{
			if( !in_array( $this->_prepare_string( $rating ), array( 'g', 'pg', 'r', 'x' ))){
				return false;
			}else{
				$this->gravatar_rating = $this->_prepare_string( $rating );
				return true;
			}
		}
	}

	// ---------------------------------------------------------------------------------------------

	/**
	 * Získá URL adresu k vygenerovanému gravataru
	 *
	 * @return string URL adresa k obrázku gravataru
	 */
	public function get(){
		if( empty( $this->email )){
			return '';
		}else{
			return $this->gravatar_url . md5( $this->email ) . '?s=' . $this->gravatar_size . '&d=' . $this->gravatar_type . '&r=' . $this->gravatar_rating;
		}
	}

	// ---------------------------------------------------------------------------------------------

	/**
	 * Kontrola správnosti emailové adresy
	 *
	 * @param string Emailová adresa
	 * @return bool Zda je platná nebo ne
	 */
	private function _check_email( $email ){
		return filter_var( $email , FILTER_VALIDATE_EMAIL);
	}

	// ---------------------------------------------------------------------------------------------

	/**
	 * Úprava zadaného textu
	 *
	 * (převedení na malá písmena a odstranění prázdných znaků)
	 *
	 * @param string Text
	 * @return string Upravený text
	 */
	private function _prepare_string( $string ){
		return trim( strtolower( $string ));
	}

	// ---------------------------------------------------------------------------------------------
}
