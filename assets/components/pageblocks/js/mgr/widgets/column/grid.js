PageBlocks.grid.Column=function(e){(e=e||{}).id||(e.id="pb-grid-column"),Ext.applyIf(e,{baseParams:{action:"mgr/column/getlist",model_type:e.model_type,model_id:e.model_id,sort:"menuindex",dir:"asc"},ddAction:"mgr/column/sort",multi_select:!1,paging:!1}),PageBlocks.grid.Column.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.grid.Column,PageBlocks.grid.Default,{createObject:function(e,t){var d=MODx.load({xtype:"pb-column-window-create",id:Ext.id(),record:{model_type:this.model_type,model_id:this.model_id},listeners:{success:{fn:function(){this.refresh()},scope:this}}});d.reset(),d.setValues({published:!0,model_type:this.model_type,model_id:this.model_id}),d.show(t.target)},getFields:function(){return["id","caption","name","width","render","published","actions"]},getColumns:function(){return[{header:_("pb_field_caption"),dataIndex:"caption",sortable:!0,width:"auto"},{header:_("pb_field_name"),dataIndex:"name",sortable:!0,width:"auto"},{header:_("pb_grid_render"),dataIndex:"render",sortable:!0,width:120,fixed:!0},{header:_("pb_grid_width"),dataIndex:"width",sortable:!1,width:100,fixed:!0},{header:_("pb_grid_actions"),dataIndex:"actions",renderer:PageBlocks.utils.renderActions,sortable:!1,width:125,fixed:!0,id:"actions",hidden:"2"!==PageBlocks.config.modxversion}]},getTopBar:function(){return[{text:'<i class="icon icon-plus"></i>&nbsp;'+_("pb_row_create"),handler:this.createObject,scope:this}]}}),Ext.reg("pb-grid-column",PageBlocks.grid.Column);