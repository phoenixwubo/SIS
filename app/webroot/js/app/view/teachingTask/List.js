/**
 * 显示课务分工
 */
Ext.define('SIS.view.teachingTask.List', {
	extend : 'Ext.grid.Panel',
	alias : 'widget.teachingtasklist',

	title : '课程目录',
	store : 'TeachingTasks',
	stripeRows : true,

	dockedItems : [ {
		xtype : 'addeditdelete'
	} ,
	{
		xtype:'pagenate',
		store:'TeachingTasks'
	}],
	initComponent : function() {
		this.columns = [ {
			header : 'ID',
			dataIndex : 'id',
			flex : 1
		}, {
			header : '课程名称',
			dataIndex : 'course_id',
			flex : 1,
			renderer : function(value, metaData, record) {
				var coursesStore = Ext.getStore('Courses');
				var course = coursesStore.findRecord('id', value);
				return course != null ? course.get('course_name') : value;
			}
		}, {
			header : '班级',
			dataIndex : 'department_id',
			flex : 1,
			renderer : function(value, metaData, record) { // #2
				var usersStore = Ext.getStore('departments.DepartmentsList');
				var user = usersStore.findRecord('id', value);
				return user != null ? user.get('dept_name') : value;
			}
		}, {
			header : '任课教师',
			dataIndex : 'user_id',
			flex : 1,
			renderer : function(value, metaData, record) { // #2
				var usersStore = Ext.getStore('Users');
				var user = usersStore.findRecord('id', value);
				return user != null ? user.get('fullname') : value;
			}
		},
		/// {header: '成绩类型', dataIndex: 'score_type', flex: 1,renderer:this.renderScoreType},
		// {header: '课程类型', dataIndex: 'coursePlan_type', flex: 1,renderer:this.renderCourseType},
		{
			header : '学期',
			dataIndex : 'semester_id',
			flex : 1,
			renderer : function(value, metaData, record) { // #2
				var semestersStore = Ext.getStore('Semesters');
				var semester = semestersStore.findRecord('id', value);
				return semester != null ? semester.get('sem_name') : value;
			}
		}, {
			header : '备注',
			dataIndex : 'note',
			flex : 1
		}

		];

		this.callParent(arguments);
	},

});