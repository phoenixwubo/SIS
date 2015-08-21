Ext.define('SIS.controller.Users', {
    extend: 'Ext.app.Controller',
    
    models: ['User'],
    stores:['Users'],
    views:[
           'user.List',
           'user.Edit',
           'user.Add'
    ],
    refs:[{
    	ref : 'userList',
    	selector:'userlist'
    }],
    
    init: function() {

		this.control({
			'userlist': {
            beforerender: this.onUserPanelRendered
        },
			'tabcontainer > userlist':{
			itemdblclick:this.editUser
		},
			'useredit button[action=save]':{
			click:this.updateUser
		},
			'userlist button[id=add_user]':{
			click:this.addUserForm
		
		},
			'userlist button[id=delete_user]':{
			click:this.onDeleteUser
		
		},'useradd button[action=add]':{
			click:this.addUser
		}
		});
    },
    editUser:function(grid, record){
    	console.log('Double clicked on '+record.get('name'));
    	var view = Ext.widget('useredit');

        view.down('form').loadRecord(record);
        
        
    },

    updateUser:function(button){
    	//console.log('clicked the save button');
        var win    = button.up('window'),
        form   = win.down('form'),
        record = form.getRecord(),
        values = form.getValues();
        
	    record.set(values);
	    //console.log(values);
	    
	    ///console.log(tempStore);
	   // record.commit();
	    win.close();
	   
	    // synchronize the store after editing the record
	   this.getUsersStore().sync({  
	        success: function(form, action) {
		   		//console.log(form);
           		//alert(Ext.JSON.decode(action));
		   		alert("成功");
	   				},  
	   		failure: function(form, action) {  
	   			alert("更新失败");  
	   			}  
  });
	   
	    //this.stores.sync()
    },
    addUserForm:function(){
    	//alert("再来一个");
    	var addUserview=Ext.widget('useradd');
    },
    addUser:function(button){
        var win    = button.up('window'),
        form   = win.down('form'),
        record = form.getRecord(),
        values = form.getValues();
        var store = this.getUsersStore();
        var record = Ext.create('SIS.model.User', values);  
        console.log(record);
        store.add(record);  
    	this.getUsersStore().sync({  
	        success: function(form, action) {
		   		//console.log(form);
           		//alert(Ext.JSON.decode(action));
	        	store.reload();
		   		alert("注册成功");
	   				},  
	   		failure: function(form, action) {  
	   			alert("注册失败"); } 
	   			}  );
        win.close();
    	console.log(values)
    	//var addUserview=Ext.widget('useradd');
    },
    onDeleteUser:function(){

    	console.log("删除");
    	var grid=this.getUserList();
    	//var grid=Ext.get('studentlist');
    	var sm=grid.getSelectionModel();
    	var store=this.getUsersStore();
    	if(sm.getSelection().length==0){
    		alert('请选择一条记录')}
    	else{
    		console.log(sm.getSelection()[0].data.id);
    		
    		Ext.MessageBox.confirm('删除记录','确定要删除'+sm.getSelection()[0].data.username+'？',function(btn){
    			if(btn == 'yes'){
					store.remove(sm.getSelection());
					store.sync({
						success : function(form, action) {
							// console.log(form);
							// alert(Ext.JSON.decode(action));

							alert("删除成功");
						},
						failure : function(form, action) {
							alert("删除失败");
						}
					});
    			}
    		});

    	}

    	
    
    },
    onUserPanelRendered:function() {
        console.log('The user panel was rendered');
        //console.log(this.stores);
        this.getStore('Users').autoLoad=true;
        this.getStore('Users').reload();        //此时装载 数据 
    }
    
    
});