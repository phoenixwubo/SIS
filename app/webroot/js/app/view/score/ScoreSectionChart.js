Ext.define('SIS.view.score.ScoreSectionChart', {
	extend : 'Ext.panel.Panel',
	alias : 'widget.scoresectionchart',
	title : 'Score Section Chart',
	layout : 'border',
	bodyPadding : 10,
	defaults: {
	    collapsible: true,
	    split: true,
//	    bodyPadding: 15
	},	
	frame : true,
	autoShow : true,
	initComponent : function() {
		this.dockedItems = [ {
			xtype : 'filtscore'
		} ];

		this.items = [
//{//子元素的方位：north、west、east、center、south
//
//	region: 'north',
//
//	 title: '北',
//
//	xtype: "panel",
//
//	html: "子元素1",
//
//	height: 70},

	 {

	region: 'west',

	title: '分数段堆叠统计图',

	xtype: "panel",
	 layout:'fit',
	html: "子元素2",
    items:[{
	width: 600,

	
//	
        xtype: 'chart',
//        width: '100%',
        id:'areachart',
//        width:200,
//        height: 410,
        padding: '10 0 0 0',
        animate: true,
        shadow: false,
        style: 'background: #fff;',
        legend: {
            position: 'right',
            boxStrokeWidth: 0,
            labelFont: '12px Helvetica'
        },
        store : 'scores.ScoreSections',
        insetPadding: 40,
        items: [],
        axes: [{
            type: 'numeric',
            position: 'left',
            grid: true,
            minimum: 0,
            maximum:100,
        }, {
            type: 'category',
            fields: 'section',
            position: 'bottom',
            grid: true,
            label: {
                rotate: {
                    degrees: -45
                }
            }
        }],
        series: [{
            type: 'area',
            axis: 'left',
            style: {
                opacity: 0.80
            },
            highlight: {
                fill: '#000',
                'stroke-width': 2,
                stroke: '#fff'
            },
            tips: {
                trackMouse: true,
                style: 'background: #FFF',
                height: 20,
                renderer: function(storeItem, item) {
                    var department = item.series.title/*[Ext.Array.indexOf(item.series.yField, item.storeField)]*/;
                    this.setTitle(browser + ' for ' + storeItem.get('section') + ': ' + storeItem.get(item.storeField) + '人');
                }
            }
        }]
//	
	
	
	

}
       
       ]


	

	}, {

	region: 'east',

	title: '分数段统计表',

	xtype: "grid",
	store:'scores.ScoreSections',
	id:'sectionGrid',
	columns:[],
	defaults:{
		width : 65
	},
	sortableColumns:false,
	html: "子元素2",

	width: 250}, {

	region: 'center',

	title: '分数段折线图',

	xtype: "panel",
	 layout:'fit',
	html: "子元素3",
	    items:[{
	           id:'sectionchart',
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
				items : [ {} ],
				axes : [ {
					type : 'Numeric',
					position : 'left',
					fields : [],
					title : '分数段人数',
					grid : true,
					minimum : 0,
					maximum: 40
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
				series : [ 		]
			}
	           
	           ]


	}, {

	region: 'south',

	title: '平均分',

	xtype: "panel",
	layout:'border',

	defaults: {
	    collapsible: true,
	    split: true,
//	    bodyPadding: 15
	},
	html: "子元素4",
	items:[
	       
	       {
	    	   region:'center',
	    	   xtype: "panel",
	   	    layout:'fit',
	   	 items:[{
	   		 	title:'平均分统计图',
		    	padding: '10 0 0 0',
		    	xtype:'chart',
		    	animate: true,
		        shadow: true,
		        id:'averagechart',
		        store:'scores.Averages',
		        axes: [{
		            type: 'Numeric',
		            position: 'left',
		            fields: ['average'],
//		            label: {
//		                renderer: Ext.util.Format.numberRenderer('0,0')
//		            },
		            title: '平均分',
		            grid: true,
		            maximum:100,
		            minimum: 0
		        }, {
		            type: 'Category',
		            position: 'bottom',
		            fields: ['dept_number'],
		            title: '班级'
		        }],
		        series: [{
		            type: 'column',
		            axis: 'left',
		            highlight: true,
		            tips: {
		                trackMouse: true,
		                renderer: function(storeItem, item) {
		                    this.setTitle(storeItem.get('name') + ': ' + storeItem.get('data1') + ' $');
		                }
		            },
		            label: {
		                display: 'outside',
		                'text-anchor': 'middle',
		                field: 'average',
		                renderer: Ext.util.Format.numberRenderer('0.0'),
//		                orientation: 'vertical',
		                color: '#333'
		            },
		            xField: 'dept_number',
		            yField: 'average'
		            	}]
	   	 }]
	       },
	       {
	    	   title:'平均分统计表',
	    	   region:'east',
	    	   xtype: "grid",
	    		store:'scores.Averages',
	    		id:'averageGrid',
	    		columns:[{
	    			header:'项目',
	    			dataIndex:'dept_number'
	    		},{
	    			header:'均分',
	    			dataIndex:'average'
	    			
	    		}],

	    		html: "子元素5",

	    		width: 200
	    	   
	       }
	       ],

	height: 250}],
		this.callParent(arguments);
	}

});