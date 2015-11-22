
Ext.define('SIS.view.coursePlan.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.addcourseplan',

    title: '添加课程计划',
    layout: 'fit',
    autoShow: true,
    modal: true,
  
    initComponent:function() {
        this.items = [
                      {
                          xtype: 'form',
          			    items : [{

                        	xtype:'radiogroup',
                        	fieldLabel:'课程类别',
                        	items:[{boxLabel:'必修',name:'course_type',inputValue:'1',checked:'true'},
                        	       {boxLabel:'选修',name:'course_type',inputValue:'2'}
                        	       ],
                        	 listeners:{

                        		 change: function (field, newValue, oldValue) { 
    								   value=newValue['course_type'];
    								   course_combo=field.up('window').down('form combo[name=course_id]');
    								   store=course_combo.getStore();
    								 store.isFiltered() ? store.clearFilter() :'' ;
    								
    								   store.filter({
    									 property:  'course_type',
    									  value: value,
    									  exactMatch: true,
    									  caseSensitive: true
    									  
    								   });
    							   } 
    							  
                        	 }
                        
  						},{
  							xtype:'radiogroup',
  							fieldLabel:'成绩类型',
  							items:[{boxLabel:'考试',name:'score_type',inputValue:'1',checked:'true'},
  							       {boxLabel:'考查',name:'score_type',inputValue:'2'}]
  						},
		             {
						xtype : 'combobox',
						fieldLabel : '课程名称',
						name : 'course_id',
						displayField:'course_name',
						valueField:'id',
						queryMode:'local',
						store:'Courses',
						listeners:{
						   select:function(combo,record,opts) { 
//          							      alert( record[0].get("value"));
//          							      alert( record[0].get("text"));
							   value=Number(combo.getValue());
							   course_radio=combo.up('window').down('form radio[name=course_type]');

							   user_combo=combo.up('window').down('form combo[name=user_id]');
							   store=user_combo.getStore();
							 store.isFiltered() ? store.clearFilter() :'' ;
							   //选修不过滤
							   
							   if(course_radio.getGroupValue()==1){
								   console.log('是1');
								
								   store.filter({
									 property:  'main_subject',
									  value: value,
									  exactMatch: true,
									  caseSensitive: true
									  
								   });
							   }else{
								   console.log('不是1');
							   }
						
						   } 
						  }   
		
					}, {
          							xtype : 'combobox',
          			
          							fieldLabel : '任课教师',
          							name : 'user_id',
          							displayField:'fullname',
          							valueField:'id',
          							queryMode:'local',
          							store:'users.UsersList'
          			
          						}, {
          							xtype : 'combobox',
          							name : 'semester_id',
          							fieldLabel : '学期',
          							displayField:'sem_name',
          							valueField:'id',
          							value:1,
          							queryMode:'local',
          							store:'Semesters'
          						}, {
          							xtype : 'combobox',
          							name : 'department_id',
          							fieldLabel : '班级',
          							displayField:'dept_name',
          							valueField:'id',
          							queryMode:'local',
          							store:'departments.DepartmentsList'
          						},{
          							xtype: 'hiddenfield',
          					        name: 'implement',
          					        value:0
          						}
          			
          						 ]
                      }
                  ];
       
        
       
        this.buttons = [
            {
                text: '添加',
                
                action: 'add'
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