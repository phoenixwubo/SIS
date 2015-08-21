Ext.define('SIS.controller.Manu',{
		extend:'Ext.app.Controller',
		models:['Department'],
		stores:['Departments'],
		views:['SIS.view.TabHome'],
		refs:[{
			ref:'manu',
			selector:'tabcontainer'
		},{
			ref:'tabcontainer',
			selector:'tabcontainer'
		}],
		init:function(){
			this.control({
					/*'departmentTree':{
						itemclick:this.onDeptItemClick
					},*/
					'manu>treepanel':{
						itemclick:this.onStudentItemClick
						}/*,
						'manu > treepanel[id=course]':{
								itemclick:this.onCourseItemClick
						},
						'manu > treepanel[id=system]':{
								itemclick:this.onSystemItemClick
						},
						'manu > treepanel[id=score]':{
								itemclick:this.onScoreItemClick
						}*/,'tabcontainer button[id=closeall]':{
							click:this.onCloseAll
						}
					}
					
					)
		},
		onDeptItemClick:function(view, record, item, index, event,options){
			id=record.get('id');
			//console.log('节点id',id);

			var tabs=this.getTabcontainer();
			var tab = tabs.getComponent('studentlist'); 
			if(!tab){//如果被关闭
				tabs.add({//新建一个tab
		    	xtype:'studentlist',
		    	iconCls:'students',
		    	title:'学生信息',
		    	id:'studentlist',
		    	closable: true
				}).show();
				tab = tabs.getComponent('studentlist'); 
				}else{//如果存在
				tabs.setActiveTab(tab);//Active
				} 
			store=tab.getStore('Students');
			tabs.setActiveTab(tab);
			
			store.on('beforeload', function (store, options) {
		        var new_params = { deptid:id };
		        Ext.apply(store.proxy.extraParams, new_params);
		        // alert('beforeload');
		    });
			store.load({params:{start:0,page:1}});
			
			//console.log(store.pageSize);
			},
			bakonStudentItemClick:function(view, record, item, index, event,options){
				id=record.get('id');
				console.log('节点id',id);

				var tabs=this.getTabcontainer();
				var tab = tabs.getComponent(id); 
				if(!tab){//如果被关闭
					tabs.add({//新建一个tab
			    	xtype:id,
			    	iconCls:'students',
			    	title: record.get('text'),
			    	id:'studentlist',
			    	closable: true
					}).show();
					tab = tabs.getComponent('studentlist'); 
					}else{//如果存在
					tabs.setActiveTab(tab);//Active
					} 
				store=tab.getStore('Students');
				tabs.setActiveTab(tab);
				
				store.on('beforeload', function (store, options) {
			        var new_params = { deptid:id };
			        Ext.apply(store.proxy.extraParams, new_params);
			        // alert('beforeload');
			    });
				store.load({params:{start:0,page:1}});
				
				//console.log(store.pageSize);
				},
				
				onStudentItemClick:function(view, record, item, index, event,options){
					id=record.get('id');
					text=record.get('text');
					//console.log('学生！',id);
					var tabs=this.getTabcontainer();
					var tab = tabs.getComponent(id); 
					if(!tab){//如果不存在
						tabs.add({//用点击树的节点的ID、text新建一个tab
						id:id,
						closable: true,
						title:text,
						iconCls:record.get('iconCls'),
						xtype:id　　//将tree设置好的id对应的TabPanel中去，相当与把对应的view填充到TabPanel中
						}).show();
						}else{//如果存在
						tabs.setActiveTab(tab);//Active
						} 
					

				},
				
			onCourseItemClick:function(view, record, item, index, event,options){
				id=record.get('id');
				text=record.get('text');
				console.log('课程！',id);
				var tabs=this.getTabcontainer();
				var tab = tabs.getComponent(id); 
				if(!tab){//如果不存在
					tabs.add({//用点击树的节点的ID、text新建一个tab
					id:id,
					closable: true,
					title:text,
					iconCls:record.get('iconCls'),
					xtype:id　　//将tree设置好的id对应的TabPanel中去，相当与把对应的view填充到TabPanel中
					}).show();
					}else{//如果存在
					tabs.setActiveTab(tab);//Active
					} 
				

			},
			
			onSystemItemClick:function(view, record, item, index, event,options){
				id=record.get('id');
				text=record.get('text');
				console.log('系统！',id);
				var tabs=this.getTabcontainer();
				var tab = tabs.getComponent(id); 
				if(!tab){//如果不存在
					tabs.add({//用点击树的节点的ID、text新建一个tab
					id:id,
					closable: true,
					title:text,
					iconCls:record.get('iconCls'),
					xtype:id　　//将tree设置好的id对应的TabPanel中去，相当与把对应的view填充到TabPanel中
					}).show();
					}else{//如果存在
					tabs.setActiveTab(tab);//Active
					} 
				

			},
			
			onScoreItemClick:function(view, record, item, index, event,options){
				id=record.get('id');
				text=record.get('text');
				//console.log('系统！',id);
				var tabs=this.getTabcontainer();
				var tab = tabs.getComponent(id); 
				if(!tab){//如果不存在
					tabs.add({//用点击树的节点的ID、text新建一个tab
					id:id,
					closable: true,
					title:text,
					iconCls:record.get('iconCls'),
					xtype:id　　//将tree设置好的id对应的TabPanel中去，相当与把对应的view填充到TabPanel中
					}).show();
					}else{//如果存在
					tabs.setActiveTab(tab);//Active
					} 
				

			},
			
			onCloseAll:function(){
				//console.log('全部关闭');
				var tabs=this.getTabcontainer();
				tabs.removeAll();
				tabs.add({
					id:'tabhome',
					xtype:'tabhome'　　
					}).show();
			}
		
})