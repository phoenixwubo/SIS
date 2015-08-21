Ext.define('SIS.view.score.SubjectScoreList' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.subjectscorelist',

    title: '成绩录入修改',
    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    autoload:false,
    stripeRows: true,
    dockedItems: [
                  {
                      xtype: 'filtscore'
                  }
                  ,{
                	  xtype:'pagenate',
                	  store: 'scores.SubjectScores',items:[  
                	                         '-', {  
                	                             xtype: 'button',      
                	                             text: '保存',  
                	                             pressed: true,
                	                             id:'save',
                	                             enableToggle: true  
                	                         }]
                  }
              ],
    renderGender:function(value){
	if(value==1){
		return "男";

	}else{
		return "女";
	}
	},	


    initComponent: function() {
		this.items=[{
            margin: '10 0 0 0',
            xtype: 'grid',
            flex: 1,
            store:'scores.SubjectScores',
            plugins: [
	          Ext.create('Ext.grid.plugin.CellEditing', {
	              clicksToEdit: 1
	          })
	      ],
            columns: [
                      /* {header: 'ID',  dataIndex: 'id',  flex: 1},     
                      {header: '课程名称',  dataIndex: 'course_plan_id',  flex: 1,
                       	renderer : function(value, metaData, record) { // #2
           					var coursePlansStore = Ext.getStore('coursePlans.CoursePlanLists');
           					var courseinfo = coursePlansStore.findRecord('id', value);
           					return courseinfo != null ? courseinfo.get('course_info') : value;
           				}},
           			{header:'班级',dataIndex:'dept_number',
           					renderer : function(value, metaData, record) { // #2
           						var departmentsStore = Ext.getStore('departments.DepartmentsRead');
           						var department = departmentsStore.findRecord('dept_number', value);
           						return department != null ? department.get('dept_name') : value;
           					}
           			},
                       {header: '学号',  dataIndex: 'stu_number'},
                       {header: '姓名',dataIndex: 'stu_name'

                       },
                       {header:'平时',dataIndex:'regular',
                       	editor: {
                               xtype: 'numberfield',
                               allowBlank: false,
                               minValue: 0,
                               maxValue: 100
                           }
                       },
                       {header:'期中',dataIndex:'midterm',

                       	editor: {
                               xtype: 'numberfield',
                               allowBlank: false,
                               minValue: 0,
                               maxValue: 100
                           }
                       },
                       {header:'期末',dataIndex:'final',

                       	editor: {
                               xtype: 'numberfield',
                               allowBlank: false,
                               minValue: 0,
                               maxValue: 100
                           }
                       },
                       {header:'总评',dataIndex:'total',
                       }
            
                       
                   */ ],
            autoScroll:true,
//            height:400,
            viewConfig: {
                emptyText: '请从上面的下拉框中选择筛选条件',
                deferEmptyText: false
            }
        }];
        this.callParent(arguments);
    }
});