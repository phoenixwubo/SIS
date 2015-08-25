Ext.define('SIS.view.elective.Import' ,{
//    extend: 'Ext.form.FormPanel',
	  extend: 'Ext.window.Window',
	  alias: 'widget.importelective',
	  autoShow: true,
	  modal: true,
    title: '导入学生选修课信息',
    fileUpload:true,
    frame:true,
    items:{
    	xtype:'form',
//    	layout: "form",
    	id:'importelective',
    	items:[{
				xtype:'combobox',
				name : 'semester_id',
				fieldLabel : '学期',
				displayField:'sem_name',
				valueField:'id',
				value:1,
				queryMode:'local',
				store:'Semesters'
			},
		           {
		    	xtype:'fileuploadfield',
		    	fieldLabel:'上传',
		        name:'import'
		    }
                   ],            
                   buttons: [{
	        text: '上传数据',
	        handler: function(){
				win=this.up('window');
	            var form = win.down('form');
	            console.log(form);
	            var semester_id=form.down('combobox').getValue;
	            if (form.isValid()) {
	                form.submit({
	                    url: 'electives/import/'+semester_id,
	                    waitMsg: 'Uploading...',
	                    success: function (f, a) {
	                        var result = a.result, data = result.data,
	                          name = data.name, size = data.size,
	                        message = Ext.String.format('<b>Message:</b> {0}<br>' +
	                          '<b>FileName:</b> {1}<br>' +
	                          '<b>FileSize:</b> {2}',
	                          result.msg, name, size);
	                        Ext.Msg.alert('Success', message);
	                        win.close();
	                      },
	                      failure: function (f, a) {
	                        Ext.Msg.alert('Failure', a.result.msg);
	                      }
	                    	}); }
	            
	        }
	    }]     
    }
            
//            bodyPadding:5,
//            border: false,
//            
//		    
   
                   
                   
//           ]
    
 
});