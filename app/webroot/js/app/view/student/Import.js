Ext.define('SIS.view.student.Import' ,{
//    extend: 'Ext.form.FormPanel',
	  extend: 'Ext.window.Window',
	  alias: 'widget.importstudent',
	  autoShow: true,
    title: '导入学生信息',
    fileUpload:true,
    frame:true,
    items:[{
    	xtype:'fileuploadfield',
    	fieldLabel:'上传',
        name:'import'
    }],
    buttons: [{
        text: '上传数据',
        handler: function(){
            var form = this.up('form').getForm();
            if (form.isValid()) {
                form.submit({
                    url: 'students/import/',
                    waitMsg: 'Uploading...',
                    success: function (f, a) {
                        var result = a.result, data = result.data,
                          name = data.name, size = data.size,
                        message = Ext.String.format('<b>Message:</b> {0}<br>' +
                          '<b>FileName:</b> {1}<br>' +
                          '<b>FileSize:</b> {2}',
                          result.msg, name, size);
                        Ext.Msg.alert('Success', message);
                      },
                      failure: function (f, a) {
                        Ext.Msg.alert('Failure', a.result.msg);
                      }
                    	}); }
        }
    }] 
 
});