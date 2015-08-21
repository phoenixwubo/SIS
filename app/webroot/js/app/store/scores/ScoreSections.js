
Ext.define('SIS.store.scores.ScoreSections', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.score.ScoreSection',
    autoLoad:false,
    proxy:{
    	
    	  type: 'ajax',
    	  url:'scores/stat_scores_section/',
//    api:{
////		create:'scores/add/',			
//		read: 'students/statNativePlace/',
////		update:'scores/edit/',
////		destroy:'scores/delete/'
//	},
    
    reader: {
        type: 'json',
        root: 'scoreSectionInJson',
        totalProperty:'totalScoreSection',
        successProperty: 'success'
    }
    }
  
//
//    data: [
//           { native_place: '江苏南京', number: 13 },
//           { native_place: '浙江杭州', number: 20 },
//           { native_place: '浙江台州', number: 20 },
//           { native_place: '江西南昌', number: 200 },
//           { native_place: '福建泉州', number: 120 },
//           { native_place: '山西太原', number: 320 },
//           { native_place: '江西九江', number: 520 },
//           { native_place: '湖北武汉', number: 1020 },
//           { native_place: '广西南宁', number: 200 }
//       ]

        

});