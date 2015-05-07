<?php

class Form_API{
	
/*
* Start of the Form
* @param: $name (string) Form Name
* @param: $method (string) Form Method
* @param: $action (string) Form Action
* @param: $enctype (string) Form Enctype
*/
public static function beginForm($name,$method,$action,$enctype,$mode){
	$form_tag = '';

	$form_name = !empty($name) ? $name : 'custom';

	$form_method = !empty($method) ? $method : 'get';
	
	$form_action = !empty($action) ? $action : '';

	$form_enctype = !empty($enctype) ? 'enctype='.$enctype : '';

	$ajax_submit = ($mode=='ajax') ? true : false;

	if($ajax_submit){
		$form_tag .= '<script language="javascript">
		$("#id_'.$form_name.'").submit(function(e) {
		var dataString = $("#id_'.$form_name.'").serialize();
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: "'.$form_action.'",
            data: dataString,
            beforeSend: function(){
				$("#msg").text("Saving....");
            },
            
            success: function(result) {
            $("#msg").fadeIn(500, function() {
    			$(this).html(result);
			}).fadeOut(2000);
        	}});
        return false; /// <=== that was missing.
        e.preventDefault();  /// Or this.
    	});</script>';
	}
	
	$form_tag .= '<form name="'.$form_name.'" id="id_'.$form_name.'" method="'.$form_method.'" action="'.$form_action.'" '.$form_enctype.'>';
	
	return $form_tag;
}

/*
* End of the Form 
*/
public static function endForm(){
	return '</form>';
}

/*
* Display Form Elements
* @param $label (string) Display Label
* @param $type (string) Element Type
* @param $attr (Array) Element Attributes
* @param $inline (bool) Display Elements inline or not
* @param $div (bool) Display within DIV Tag or not
* @param $title (string) Display Title
* @param $options (array) Display options for Select type
*/
public static function input($label,$type,$attr,$inline=false,$div=false,$title,$options){
	$output = '';
	$set_att = '';
	$set_break = '';
	$opt = '';

	if($title) $output .= '<h4>'.ucfirst($title).'</h4>';

	if($label) $output .= '<label for='.$label.'>'.ucfirst($label).'</label>';
	
	if(is_array($attr)){
		foreach($attr as $k=>$v){
			$set_att .= str_replace('#','',$k).'='.$v.' ';
		}
	}
	
	if(is_array($options)){
		if(in_array('empty',$options)) $opt .= '<option value="">Please select</option>';
			if(($key = array_search('empty', $options)) !== false) unset($options[$key]);

		foreach($options as $k=>$v){
			if(is_array($v)){
				foreach ($v as $key=>$value) {
					$opt .= '<option value='.$key.'>'.ucfirst($value).'</option>';
				}
			}else{
				$opt .= '<option value='.$k.'>'.ucfirst($v).'</option>';
			}
		}
	}
	
	if($inline) $set_break = '<br />';

	if($type){
		switch($type){
			case 'text' 	: 	$output .= '<input type='.$type.' '.$set_att.' />'.$set_break;
								break;
								
			case 'checkbox' :	$output .= '<input type='.$type.' '.$set_att.' />'.$set_break;
								break;
								
			case 'radio'	:	$output .= '<input type='.$type.' '.$set_att.' />'.$set_break;
								break;
			
			case 'textarea'	:	$output .= '<textarea '.$set_att.'></textarea>'.$set_break;
								break;

			case 'file' 	: 	$output .= '<input type='.$type.' '.$set_att.' />'.$set_break;
								break;
								
			case 'select' 	: 	$output .= '<select '.$set_att.'>'.$opt.'</select>'.$set_break;
								break;

			case 'submit' 	: 	$output .= '<input type='.$type.' '.$set_att.' />'.$set_break;
								break;

			case 'button' 	: 	$output .= '<input type='.$type.' '.$set_att.' />'.$set_break;
								break;
			}
	
	if($div) $output = '<div class='.$label.'>'.$output.'</div>'; 

	return $output;
	//return '<pre>'.print_r($attr).'</pre>';
}
	
}
}

/*$f = new Form;
$f -> beginForm('myform','post','test.php','');
$f -> input('name','text',array('#name'=>'first_name','#value'=>'Ashok'),true,true,'name','');
$f -> input('address','textarea',array('#name'=>'address','#cols'=>40,'#rows'=>6),true,false,'','');
$f -> input('male','radio',array('#name'=>'r1','#value'=>'male'),false,false,'gender','');
$f -> input('female','radio',array('#name'=>'r1','#value'=>'female'),true,false,'','');
$f -> input('sports','checkbox',array('#name'=>'c1','#value'=>'sports'),true,false,'hobbies','');
$f -> input('reading','checkbox',array('#name'=>'c1','#value'=>'reading'),true,false,'','');
$f -> input('writing','checkbox',array('#name'=>'c1','#value'=>'writing'),true,false,'','');
$f -> input('city','select',array('#name'=>'city'),true,true,'city',array('empty','chandigarh','mohali','panchkula'));
$f -> input('upload','file',array('#name'=>'file'),true,false,'upload','');
$f -> input('','submit',array('#name'=>'submit','#value'=>'Save'),true,false,'','');
$f -> endForm();*/