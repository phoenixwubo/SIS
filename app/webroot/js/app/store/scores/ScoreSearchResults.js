
Ext.define('SIS.store.scores.ScoreSearchResults', {
    extend: 'Ext.data.Store',
    model: 'SIS.model.score.StudentScore',
    autoLoad:false,
    

        
    proxy: {
        type: 'ajax',
        api:{
//			create:'scores/add/',			
			read: 'scores/listResults/',
//			update:'scores/edit/',
//			destroy:'scores/delete/'
		},
        
        reader: {
            type: 'json',
            root: 'studentScoreInJson',
            totalProperty:'totalStudentScore',
            successProperty: 'success'
        }
}
});