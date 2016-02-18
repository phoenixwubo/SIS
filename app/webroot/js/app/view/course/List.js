/**
 *显示课程列表
 */
Ext.define('SIS.view.course.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.courselist',
   
    title: '学科目录',
    store:'Courses',
    stripeRows: true,
    renderScoreType:function(value){

		 switch (value)
	    	{
	    	case 1:return "考试";
	    	break;
	    	case 2:return '考查';
	    	break;
	    	default :return '其他';
	    	}
		 
    	
    },
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
                     xtype: 'addeditdelete'
                 }
             ],
    initComponent: function() {
        this.columns = [
                        {header: 'ID',  dataIndex: 'id',  flex: 1},            
                        {header: '学科名称',  dataIndex: 'course_name',  flex: 1},
				        {
							header : '负责教师',
							dataIndex : 'user_id',
							flex : 1,
							renderer : function(value, metaData, record) { // #2
								var usersStore = Ext.getStore('Users');
								var user = usersStore.findRecord('id', value);
								return user != null ? user.get('fullname') : value;
							}
						},
                        {header: '成绩类型', dataIndex: 'score_type', flex: 1,renderer:this.renderScoreType},
                        {header: '课程类型', dataIndex: 'course_type', flex: 1,renderer:this.renderCourseType}/*,
                        {header: '学期',  
                        	dataIndex: 'semester_id',
                        	flex: 1,
							renderer : function(value, metaData, record) { // #2
								var semestersStore = Ext.getStore('Semesters');
								var semester = semestersStore.findRecord('id', value);
								return semester != null ? semester.get('sem_name') : value;
							}},*/
                        //{header: '类型', dataIndex: 'status', flex: 1,renderer:this.renderStatus}
                        
                    ];
        
        this.callParent(arguments);
    	},
    	 
    });