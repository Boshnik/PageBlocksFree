PageBlocks.grid.Fields=function(e){(e=e||{}).id||(e.id="pb-grid-fields"),Ext.applyIf(e,{baseParams:{action:"mgr/field/getlist",sort:"menuindex",dir:"desc"},ddAction:"mgr/field/sort",multi_select:!0,pageSize:10}),PageBlocks.grid.Fields.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.grid.Fields,PageBlocks.grid.Default,{createObject:function(e,d){var i=MODx.load({xtype:"pb-field-window-create",id:Ext.id(),model_type:this.model_type,model_id:this.model_id,listeners:{success:{fn:function(){this.refresh()},scope:this}}});i.reset(),i.setValues({published:!0,model_type:this.model_type,model_id:this.model_id}),i.show(d.target)},getFields:function(){return["id","name","caption","type_lexicon","published","actions"]},getColumns:function(){return[{header:_("pb_grid_id"),dataIndex:"id",sortable:!0,width:75,fixed:!0},{header:_("pb_field_caption"),dataIndex:"caption",sortable:!0,width:"auto"},{header:_("pb_field_name"),dataIndex:"name",sortable:!0,width:"auto"},{header:_("pb_field_type"),dataIndex:"type_lexicon",sortable:!0,width:150,fixed:!0},{header:_("pb_grid_actions"),dataIndex:"actions",renderer:PageBlocks.utils.renderActions,sortable:!1,width:165,fixed:!0,id:"actions",hidden:"2"!==PageBlocks.config.modxversion}]},getSearchField:function(){return""}}),Ext.reg("pb-grid-fields",PageBlocks.grid.Fields);