Ext.define('SIS.util.Utilities', {

	 statics: { renderGender:function(value){
	    	
	    	
			if(value==1){
				return "男";
		
			}else{
				return "女";
			}
		},
		renderStatus:function(value){
			 switch (value)
		    	{
		    	case 1:return "正常";
		    	break;
		    	case 2:return '休学';
		    	break;
		    	case 3:return '毕业';
		    	break;
		    	case 4:return '旁听';
		    	break;
		    	case 5:return'复读';
		    	break;
		    	default :return '其他';
		    	}
			 }
	 }
});