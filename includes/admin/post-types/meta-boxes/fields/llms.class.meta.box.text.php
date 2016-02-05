<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* 
*/
class LLMS_Metabox_Text_Field extends LLMS_Metabox_Field implements Meta_Box_Field_Interface
{
	
	function __construct($_field)
	{
		$this->field = $_field;
	}

	/**
	 * Outputs the Html for the given field
	 * @return HTML 
	 */
	public function Output()
	{
		global $post;
		parent::Output(); ?>
					
		<input type="text" 
			name="<?php echo $this->field['id']; ?>" 
			id="<?php echo $this->field['id']; ?>"
			<?php if (array_key_exists('required', $this->field) && $this->field['required']): ?>
				required="required"
			<?php endif; ?>
			class="<?php echo esc_attr( $this->field['class'] ); ?>"
			value="<?php echo $this->meta; ?>" size="30"
		/>
			
		<?php
		parent::CloseOutput();				
	}
}

