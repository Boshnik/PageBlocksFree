PageBlocks.grid.Tabs=function(e){(e=e||{}).id||(e.id="pb-grid-tabs"),Ext.applyIf(e,{baseParams:{action:"mgr/tab/getlist",model_type:e.model_type,model_id:e.model_id,sort:"menuindex",dir:"desc"},ddAction:"mgr/tab/sort",multi_select:!0,pageSize:5}),PageBlocks.grid.Tabs.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.grid.Tabs,PageBlocks.grid.Default,{createObject:function(e,t){var d=MODx.load({xtype:"pb-tab-window-create",id:Ext.id(),model_type:this.model_type,model_id:this.model_id,listeners:{success:{fn:function(){this.refresh()},scope:this}}});d.reset(),d.setValues({published:!0,model_type:this.model_type,model_id:this.model_id}),d.show(t.target)},getFields:function(){return["id","name","published","actions"]},getColumns:function(){return[{header:_("pb_grid_id"),dataIndex:"id",sortable:!0,width:75,fixed:!0},{header:_("pb_tab_name"),dataIndex:"name",sortable:!0,width:"auto"},{header:_("pb_grid_actions"),dataIndex:"actions",renderer:PageBlocks.utils.renderActions,sortable:!1,width:165,fixed:!0,id:"actions",hidden:"2"!==PageBlocks.config.modxversion}]},getSearchField:function(){return""}}),Ext.reg("pb-grid-tabs",PageBlocks.grid.Tabs);