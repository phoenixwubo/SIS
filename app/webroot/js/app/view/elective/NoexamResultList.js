Ext.define('SIS.view.elective.NoexamResultList' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.noexamresultlist',

    title: '考查科目',
    store:'electives.Electives',
    autoload:true,
    stripeRows: true,
    renderCourseType:function(value){

		 switch (value)
	    	{
	    	case 1:return "必修";
	    	break;
	    	case 2:return '选修';
	    	break;
	    	default :return '其他';
	    	}
		 
  	
  },
  dockedItems: [
                {
                    xtype: 'addeditdeletesearch'
                },{
              	  xtype:'pagenate',
              	  store: 'Scores',items:[  
              	                         '-', {  
              	                             xtype: 'button',      
              	                             text: '保存',  
              	                             pressed: true,
              	                             id:'saveElectiveResult',
              	                             enableToggle: true  
              	                         }]
                }
            ],
	plugins: [
	          Ext.create('Ext.grid.plugin.CellEditing', {
	              clicksToEdit: 1
	          })
	      ],
    initComponent: function() {
    	this.columns = [
    	                     {header: 'ID',  dataIndex: 'id',  flex: 1},  
    	                     {header: '学期',  dataIndex: 'sem_name',  flex: 1},
    	                     {header: '课时序号',  dataIndex: 'lesson_number',  flex: 1},
    	                     {header: '课程名称',  dataIndex: 'course_id',  flex: 1,
    	                    	 renderer : function(value, metaData, record) { 
    									var coursesStore = Ext.getStore('Courses');
    									var course = coursesStore.findRecord('id', value);
    									return course != null ? course.get('course_name') : value==0 ? "<span style='color:red;'>未选择</span>":value;
    								}
    	                    	 },
	                    	 {header: '课程类型', dataIndex: 'course_type', flex: 1,renderer:this.renderCourseType},
    	                     {header: '学号',  dataIndex: 'stu_number',  flex: 1},
    	                     {header: '姓名',  dataIndex: 'stu_name',  flex: 1},
    	                     {header:'成绩',dataIndex:'result',
    	                    	 renderer : function(value, metaData, record) { 
 									var coursesStore = Ext.getStore('ResultTypes');
 									var course = coursesStore.findRecord('id', value);
 									return course != null ? course.get('result_name') : value==null ? "<span style='color:red;'>未录入</span>":value;
 								},
    	                     editor: {
	                             xtype: 'combobox',
	                             displayField:'result_name',
	                             queryMode: 'local',
       							valueField:'id',
	                             store:'ResultTypes',
	                             allowBlank: false,
    	                    	 
    	                     }}
    	                     ];
        this.callParent(arguments);

    	                     

    	                     
    }
});