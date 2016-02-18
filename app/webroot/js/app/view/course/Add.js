Ext.define('SIS.view.course.Add', {
	extend : 'Ext.window.Window',
	alias : 'widget.addcourse',

	title : '添加学科',
	layout : 'fit',
	autoShow : true,
	modal: true,
	initComponent : function() {

		var courseTypeData = [ [ 1, '必修' ], [ 2, '选修' ], [ 3, '其他' ] ];
		var courseTypeStore = new Ext.data.ArrayStore({
			fields : [ 'value', 'text' ],
			data : courseTypeData
		});

		courseTypeStore.load();

		var scoreTypeData = [ [ 1, '考试' ], [ 2, '考查' ] ];
		var scoreTypeStore = new Ext.data.ArrayStore({
			fields : [ 'value', 'text' ],
			data : scoreTypeData
		});

		scoreTypeStore.load();
		this.items = [ {
			xtype : 'form',
			items : [ {
				xtype : 'textfield',
				fieldLabel : '课程名称',
				name : 'course_name',
				displayField : 'course_name',

			}, {
				xtype : 'combobox',

				fieldLabel : '负责教师',
				name : 'user_id',
				displayField : 'fullname',
				valueField : 'id',
				queryMode:'local',
				store : 'users.UsersList',
				listener:{}

			}, {
				xtype : 'combobox',
				name : 'course_type',
				fieldLabel : '课程类型',
				displayField : 'text',
				valueField : 'value',
				value : 1,
				queryMode : 'local',
				store : courseTypeStore
			}, {
				xtype : 'combobox',
				name : 'score_type',
				fieldLabel : '成绩类型',
				displayField : 'text',
				valueField : 'value',
				value : 1,
				queryMode : 'local',
				store : scoreTypeStore
			}

			]
		} ];

		this.buttons = [ {
			text : '添加',

			action : 'add'
		}, {
			text : '取消',
			scope : this,
			handler : this.close
		} ];

		this.callParent(arguments);
	}
});