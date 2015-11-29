Ext.define('SIS.controller.Departments', {
	extend : 'Ext.app.Controller',
	models : [ 'Department' ],
	stores : [ 'Departments','departments.DepartmentsList'],
	views : [ 'department.Tree', 'department.DepartmentPanel',
			'toolbar.AddEditDelete', 'department.Add','department.Edit' ],
	refs:[{
		    	ref : 'departmentTree',
		    	selector:'departmentTree'
		    }],
	init : function() {
		// console.log('我是一棵树'),
		this.control({
			'departmentTree' : {
			 itemclick:this.onItemClick
			},
			'departmentpanel button#add' : {
				click : this.onButtonClickAddDepartment
			},
			'departmentpanel button#edit':{
				click:this.onButtonClickEditDepartment
			},
			'departmentpanel button#delete' : {
				click : this.onButtonClickDeleteDepartment
			},
			'adddepartment button[action=add]' : {
				click : this.addDepartment
			},
			'editdepartment button[action=update]' : {
				click : this.updateDepartment
			},
			'departmentTree':{
//				beforeload:this.DepartmentLoad,
//				beforerender:this.onDepartmentTreeRender
			},
			'departmentpanel':{
				beforerender:this.onDepartmentPanelRender
			},
			'departmentpanel button#upward' : {
				click : this.onButtonClickUpwardDepartment
			},
			'departmentpanel button#downward' : {
				click : this.onButtonClickDownwardDepartment
			},

		})
	},
	onDepartmentTreeRender:function(panel){
		departmenttree=panel;
		console.log(panel);
		
	},
	onItemClick : function(view, record, item, index, event, options) {
		id = record.get('text');
		console.log('节点被点击了！', id);

	/*	store = view.up('mainviewport').down('studentlist')
				.getStore('Students');

		store.on('beforeload', function(store, options) {
			var new_params = {
				deptid : id
			};
			Ext.apply(store.proxy.extraParams, new_params);
			// alert('beforeload');
		});
		store.load({
			params : {
				start : 0,
				page : 1
			}
		});

		// console.log(store.pageSize);
	*/},
	onButtonClickAddDepartment : function(view, record, item, index, event,
			options) {
		treeStore = this.getDepartmentTree().getView().getTreeStore();  
		//console.log(treeStore);
		treeStore.load();
		
		var view = Ext.widget('adddepartment');
	},
	addDepartment : function(button) {
		//treeStore = this.getDepartmentTree().getView().getTreeStore();  
		//treeStore.relaod();
		var win = button.up('window'), 
		form = win.down('form'), 
		values = form.getValues();
		//parentid=0;
		treeStore = this.getDepartmentTree().getView().getTreeStore();  
		//console.log(treeStore);
		treeStore.load();
			
		Ext.Ajax.request({
			url:'/departments/add/',
		method:'POST',
		params:values,
		
		callback:function(option,success,response){
			if(success){
				
				alert('成功！');

				
			}else{
				Ext.Msg.show({
			           title:'Error!',
			           msg: response.responseText,
			           icon: Ext.Msg.ERROR,
			           buttons: Ext.Msg.OK
			});			
			}
		}
		});
		win.close();
		//console.log(values);
		
	},
	
	onButtonClickEditDepartment:function(view,record,item,index,event,options){
		treeModel=this.getDepartmentTree().getSelectionModel();
		
		if(treeModel.getSelection().length==0){
			alert('请选择一项');
		}
		else{
			var view = Ext.widget('editdepartment');

    		var record=treeModel.getSelection()[0];
    		id=record.data.id
    		
    		
    		
    		console.log(id);
    		view.down('form').load({
    			 url: '/departments/view/'+id
    		});
    		
			/*Ext.Ajax.request({
				url:'/departments/view/'+id,
			method:'get',
			//params:id,
			
			callback:function(option,success,response){
				if(success){
					
					alert('成功！');
					//this。DepartmentLoad();
					var respText =  Ext.decode(response.responseText);
					console.log(respText);
					
					view.down('form').load(respText);

				}else{
					alert('读取失败！');
				}
			}
			});*/
			//console.log(department);
    		//view.down('form').loadRecord(record);
		}	
	},
	updateDepartment : function(button) {
		var win = button.up('window'), 
		form = win.down('form'), 
		values = form.getValues();
		id=values.id
		console.log(id)	;
		Ext.Ajax.request({
			url:'/departments/edit/'+id,
		method:'POST',
		params:values,
		
		callback:function(option,success,response){
			if(success){
				
				alert('成功！');

				
			}else{
				Ext.Msg.show({
			           title:'Error!',
			           msg: response.responseText,
			           icon: Ext.Msg.ERROR,
			           buttons: Ext.Msg.OK
			});			}
		}
		});
		win.close();
		
		this.DepartmentLoad();
		//console.log(values);
		
	},
	
	onButtonClickDeleteDepartment : function(view, record, item, index, event,
			options) {
		treeModel=this.getDepartmentTree().getSelectionModel();
		
		if(treeModel.getSelection().length==0){
			alert('请选择一项');
		}
		else{	
		data = treeModel.getSelection()[0].data;
		id=data.id;
		
		
		console.log(id);
		
	
		Ext.MessageBox.confirm('删除','确定要删除'+data.text+'？',function(btn){
			if(btn == 'yes'){
				Ext.Ajax.request({
					url:'/departments/remove/'+id+'/true',
				method:'POST',
				params:id,
				
				callback:function(option,success,response){
					if(success){
						
						alert('成功！');
						//this.DepartmentLoad();
		
						
					}else{
						Ext.Msg.show({
					           title:'Error!',
					           msg: response.responseText,
					           icon: Ext.Msg.ERROR,
					           buttons: Ext.Msg.OK
					});			
					}
				}
				});

			}
		});
		treeStore = this.getDepartmentTree().getView().getTreeStore();  
		//console.log(treeStore);
		treeStore.load();


		}
	},
	DepartmentLoad:function(store){
		console.log('渲染之前',store);
		
//		var departmentListStore = Ext.getStore('departments.DepartmentsList');
//		console.log(departmentListStore);
//		departmentListStore.reload();
//		treeStore = this.getDepartmentTree().getView().getTreeStore();  
//		//console.log(treeStore);
//		treeStore.load();
	},
	onDepartmentTreeRender:function(panel){
		console.log('渲染之前',panel)
		
	},
	onDepartmentPanelRender:function(panel){
		var toolbar=panel.down('toolbar');
		var upButton=new Ext.Button({text:'向上移',itemId:'upward',iconCls:'upward'});
		var downButton=new Ext.Button({text:'向下移',itemId:'downward',iconCls:'downward'});
		toolbar.add(upButton);
		toolbar.add(downButton);
		

	},
	onButtonClickUpwardDepartment:function()
	{

		treeModel=this.getDepartmentTree().getSelectionModel();
		
		if(treeModel.getSelection().length==0){
			alert('请选择一项');
		}
		else{	
		data = treeModel.getSelection()[0].data;
		id=data.id;
		
		
		console.log(id);
		
	
		Ext.MessageBox.confirm('调整','确定要将'+data.text+'上移？',function(btn){
			if(btn == 'yes'){
				Ext.Ajax.request({
					url:'/departments/moveup/'+id+'/1',
				method:'POST',
				params:id,
				
				callback:function(option,success,response){
					if(success){
						
						alert('成功！');
						//this.DepartmentLoad();
		
						
					}else{
						Ext.Msg.show({
					           title:'Error!',
					           msg: response.responseText,
					           icon: Ext.Msg.ERROR,
					           buttons: Ext.Msg.OK
					});			
					}
				}
				});

			}
		});
		treeStore = this.getDepartmentTree().getView().getTreeStore();  
		//console.log(treeStore);
		treeStore.load();


		}
	
	},
	onButtonClickDownwardDepartment:function()
	{

		treeModel=this.getDepartmentTree().getSelectionModel();
		
		if(treeModel.getSelection().length==0){
			alert('请选择一项');
		}
		else{	
		data = treeModel.getSelection()[0].data;
		id=data.id;
		
		
		console.log(id);
		
	
		Ext.MessageBox.confirm('调整','确定要将'+data.text+'下移？',function(btn){
			if(btn == 'yes'){
				Ext.Ajax.request({
					url:'/departments/movedown/'+id+'/1',
				method:'POST',
				params:id,
				
				callback:function(option,success,response){
					if(success){
						
						alert('成功！');
						//this.DepartmentLoad();
		
						
					}else{
						Ext.Msg.show({
					           title:'Error!',
					           msg: response.responseText,
					           icon: Ext.Msg.ERROR,
					           buttons: Ext.Msg.OK
					});			
					}
				}
				});

			}
		});
		treeStore = this.getDepartmentTree().getView().getTreeStore();  
		//console.log(treeStore);
		treeStore.load();


		}
	
	}


	
})
