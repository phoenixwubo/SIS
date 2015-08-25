Ext.define('SIS.view.semester.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.addsemester',
    title: 'New Semester',
    layout: 'fit',
    //width: 200,
    //height: 200,
    bodyPadding: 10,
    frame: true,
    autoShow: true,
    modal: true,
    renderCurrent:function(value){
	if(value==true){
		return "是";

	}else{
		return "否";
	}
	},	
    initComponent:function() {

    	

    	
    	
    	
    	this.items=[
    	            { xtype:'form', 
    	            	items:[
    	            	       {
	    	            		xtype:'textfield',
	    	            		name:'sem_name',
	    	            		value:'2014-2015学年第一学期',
	    	            		fieldLabel:'名称'
    	            	       },
    	            	       {
    	    	            		xtype:'textfield',
    	    	            		name:'year',
    	    	            		fieldLabel:'开始年份',
    	    	            		value:'2014'
    	    	            	},
    	                        {
    	                        	xtype:'radiogroup',
    	                        	fieldLabel:'学期序号',
    	                        	items:[{boxLabel:'一',name:'sem_number',inputValue:'1',checked:'true'},
    	                        	       {boxLabel:'二',name:'sem_number',inputValue:'2'},
    	                        	       ]
    	                        }
    	    	            	
    	                        
    	                        
    	                        
    	                        
    	                        
    	                        
    	            	       ]
    	            	
    	            }
    	           
    	            	];

        this.buttons = [
            {
                text:'添加',
                
                action:'add'
            },
            {
                text: '取消',
                scope: this,
                handler: this.close
            }
        ];
	            
	            this.callParent(arguments);
	            }
});