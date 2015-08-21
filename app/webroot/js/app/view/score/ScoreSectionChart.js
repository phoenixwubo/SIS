Ext.define('SIS.view.score.ScoreSectionChart', {
	extend : 'Ext.panel.Panel',
	alias : 'widget.scoresectionchart',
	title : 'Score Section Chart',
	layout : 'fit',
	bodyPadding : 10,
	frame : true,
	autoShow : true,
	initComponent : function() {
		this.dockedItems = [ {
			xtype : 'filtscore'
		} ];

		this.items = [ {

			xtype : 'chart',
			padding: '10 0 0 0',
			style : 'background:#fff',
			animate : true,
			shadow : true,
			store : 'scores.ScoreSections',
			insetPadding: 40,
			legend : {
				position : 'right',
				boxStrokeWidth : 0,
				labelFont : '12px Helvetica'
			},
			items : [ {
				type : 'text',
				text : '分数段统计',
				font : '22px Helvetica',
				width : 100,
				height : 30,
				x : 40, //the sprite x position
				y : 12
			//the sprite y position
			} ],
			axes : [ {
				type : 'Numeric',
				position : 'left',
				fields : [],

				/*            label: {
				 renderer: Ext.util.Format.numberRenderer('0,0')
				 },*/
				title : '分数段人数',
				grid : true,
				//    grid: {
				//        odd: {
				//            opacity: 1,
				//            fill: '#ddd',
				//            stroke: '#bbb',
				//            'stroke-width': 1
				//        }
				//    },
				minimum : 0,
				maximum: 40
			//    adjustMinimumByMajorUnit: 0
			}, {
				type : 'Category',
				position : 'bottom',
				fields : [ 'section' ],
				title : '分数段',
				label : {
					rotate : {
						degrees : -45
					}
				}
			} ],
			series : [ /* {
			type: 'line',
			axis: 'left',
			xField: 'section',
			yField: '2014201',
			}*/

			]
		} ], this.callParent(arguments);
	}

});