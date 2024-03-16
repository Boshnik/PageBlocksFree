PageBlocks.combo.Search=function(e){e=e||{},Ext.applyIf(e,{xtype:"twintrigger",ctCls:"x-field-search",allowBlank:!0,msgTarget:"under",emptyText:_("search"),name:"query",triggerAction:"all",clearBtnCls:"x-field-search-clear",searchBtnCls:"x-field-search-go",onTrigger1Click:this._triggerSearch,onTrigger2Click:this._triggerClear}),PageBlocks.combo.Search.superclass.constructor.call(this,e),this.on("render",function(){this.getEl().addKeyListener(Ext.EventObject.ENTER,function(){this._triggerSearch()},this)}),this.addEvents("clear","search")},Ext.extend(PageBlocks.combo.Search,Ext.form.TwinTriggerField,{initComponent:function(){Ext.form.TwinTriggerField.superclass.initComponent.call(this),this.triggerConfig={tag:"span",cls:"x-field-search-btns",cn:[{tag:"div",cls:"x-form-trigger "+this.searchBtnCls},{tag:"div",cls:"x-form-trigger "+this.clearBtnCls}]}},_triggerSearch:function(){this.fireEvent("search",this)},_triggerClear:function(){this.fireEvent("clear",this)}}),Ext.reg("pb-combo-search",PageBlocks.combo.Search),Ext.reg("pb-field-search",PageBlocks.combo.Search),PageBlocks.combo.ComboBoxDefault=function(e){e=e||{},Ext.applyIf(e,{assertValue:function(){var e,t=this.getRawValue();if(!(e=(e=this.valueField&&Ext.isDefined(this.value)?this.findRecord(this.valueField,this.value):e)&&e.get(this.displayField)!=t?null:e)&&this.forceSelection)0<t.length&&t!=this.emptyText?(this.el.dom.value=Ext.value(this.lastSelectionText,""),this.applyEmptyText()):this.clearValue();else{if(e&&this.valueField){if(this.value==t)return;t=e.get(this.valueField||this.displayField)}this.setValue(t)}}}),PageBlocks.combo.ComboBoxDefault.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.combo.ComboBoxDefault,MODx.combo.ComboBox),Ext.reg("pb-combo-combobox-default",PageBlocks.combo.ComboBoxDefault),PageBlocks.combo.SortDir=function(e){e=e||{},Ext.applyIf(e,{store:new Ext.data.ArrayStore({id:"value",fields:["display","value"],data:[["ASC","asc"],["DESC","desc"]]}),mode:"local",displayField:"display",valueField:"value"}),PageBlocks.combo.SortDir.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.combo.SortDir,MODx.combo.ComboBox),Ext.reg("pb-combo-dir",PageBlocks.combo.SortDir),PageBlocks.combo.FieldRender=function(e){e=e||{},Ext.applyIf(e,{store:new Ext.data.ArrayStore({id:"value",fields:["display","value"],data:[["",""],["renderImage","renderImage"],["renderDate","renderDate"],["renderBoolean","renderBoolean"],["renderResource","renderResource"],["renderButton","renderButton"]]}),mode:"local",displayField:"display",valueField:"value"}),PageBlocks.combo.FieldRender.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.combo.FieldRender,MODx.combo.ComboBox),Ext.reg("pb-combo-field-render",PageBlocks.combo.FieldRender),PageBlocks.combo.Types=function(e){e=e||{};var t=[[_("pb_field_type_textfield"),"textfield"],[_("pb_field_type_textarea"),"textarea"],[_("pb_field_type_listbox"),"listbox"],[_("pb_field_type_listbox_multiple"),"listbox-multiple"],[_("pb_field_type_resourcelist"),"resourcelist"],[_("pb_field_type_combo_boolean"),"combo-boolean"],[_("pb_field_type_numberfield"),"numberfield"],[_("pb_field_type_xcheckbox"),"xcheckbox"],[_("pb_field_type_checkboxgroup"),"checkboxgroup"],[_("pb_field_type_radiogroup"),"radiogroup"],[_("pb_field_type_file"),"pb-panel-file"],[_("pb_field_type_image"),"pb-panel-image"],[_("pb_field_type_video"),"pb-panel-video"],[_("pb_field_type_button"),"pb-panel-button"],[_("pb_field_type_xdatetime"),"xdatetime"],[_("pb_field_type_timefield"),"timefield"],[_("pb_field_type_table"),"pb-table"],[_("pb_field_type_colorpalette"),"colorpalette"],[_("pb_field_type_readonly"),"readonly"],[_("pb_field_type_hidden"),"hidden"],[_("pb_field_type_xtype"),"pb-xtype"]];MODx.loadRTE&&t.splice(2,0,[_("pb_field_type_richtext"),"richtext"]),(void 0!==MODx.ux&&"function"==typeof MODx.ux.Ace?1:0)&&(MODx.loadRTE?t.splice(3,0,[_("pb_field_type_texteditor"),"modx-texteditor"]):t.splice(2,0,[_("pb_field_type_texteditor"),"modx-texteditor"])),"object"==typeof ColorPicker&&t.splice(-4,0,["ColorPicker","colorpicker"]),Ext.applyIf(e,{store:new Ext.data.ArrayStore({id:"value",fields:["display","value"],data:t}),mode:"local",displayField:"display",valueField:"value"}),PageBlocks.combo.Types.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.combo.Types,MODx.combo.ComboBox),Ext.reg("pb-combo-field-types",PageBlocks.combo.Types),PageBlocks.combo.Listbox=function(e){var t=e.store||[];e.all&&t.push([_("all"),""]),Ext.isEmpty(e.values)?Ext.isEmpty(e.data)||e.data.split("||").forEach(function(e){e=e.split("==");t.push([e[0],e[1]||e[0]])}):Object.values(e.values).forEach(function(e){t.push([e.name,e.id])}),e=e||{},Ext.applyIf(e,{store:new Ext.data.SimpleStore({fields:e.fields||["display","value"],data:t}),hiddenName:e.name,displayField:"display",valueField:"value",mode:"local",triggerAction:"all",editable:1,pageSize:20,selectOnFocus:0,preventRender:1}),PageBlocks.combo.Listbox.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.combo.Listbox,PageBlocks.combo.ComboBoxDefault),Ext.reg("pb-combo-listbox",PageBlocks.combo.Listbox),PageBlocks.combo.ListboxMulti=function(e){var t=[];Ext.isEmpty(e.data)||e.data.split("||").forEach(function(e){e=e.split("==");t.push([e[0],e[1]||e[0]])}),e=e||{},Ext.applyIf(e,{xtype:"superboxselect",store:new Ext.data.ArrayStore({id:0,fields:["display","value"],data:t}),mode:"local",displayField:"display",valueField:"value",triggerAction:"all",extraItemCls:"x-tag",expandBtnCls:"x-form-trigger",clearBtnCls:"x-form-trigger",renderTo:Ext.getBody()}),e.name+="[]",PageBlocks.combo.ListboxMulti.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.combo.ListboxMulti,Ext.ux.form.SuperBoxSelect),Ext.reg("pb-combo-listbox-multiple",PageBlocks.combo.ListboxMulti),PageBlocks.combo.Resource=function(e){e=e||{},Ext.applyIf(e,{url:PageBlocks.config.connectorUrl,name:"resource",hiddenName:e.name,id:Ext.id(),fieldLabel:_("resource"),fields:["id","pagetitle"],valueField:"id",displayField:"pagetitle",baseParams:{action:"web/combo/resourcelist",sort:"id",dir:"asc",limit:10,combo:1},editable:1,emptyText:_("pb_combo_empty"),anchor:"100%",width:"100%",pageSize:10,allowBlank:1}),PageBlocks.combo.Resource.superclass.constructor.call(this,e)},Ext.extend(PageBlocks.combo.Resource,PageBlocks.combo.ComboBoxDefault),Ext.reg("pb-combo-resource",PageBlocks.combo.Resource),PageBlocks.combo.Getlist=function(e){(e=e||{}).clearBtn&&(e.triggerConfig={tag:"div",cls:"pb-combo-btns",cn:[{tag:"div",cls:"x-form-trigger x-field-combo-list"},{tag:"div",cls:"x-form-trigger icon icon-close",trigger:"clear"}]},e.onTriggerClick=function(e,t){"clear"===t.getAttribute("trigger")?(this.setValue(""),this.fireEvent("select",this)):this.__proto__.onTriggerClick.call(this)}),Ext.applyIf(e,{url:PageBlocks.config.connectorUrl,hiddenName:e.name,id:Ext.id(),fields:["id",e.displayField||"name"],valueField:"id",displayField:"name",editable:1,emptyText:_("pb_combo_empty"),anchor:"100%",width:100,pageSize:10,allowBlank:1}),PageBlocks.combo.Getlist.superclass.constructor.call(this,e),setTimeout(()=>{e.store.load({params:{limit:e.pageSize}})},1e3)},Ext.extend(PageBlocks.combo.Getlist,PageBlocks.combo.ComboBoxDefault),Ext.reg("pb-combo-getlist",PageBlocks.combo.Getlist),PageBlocks.combo.GetListMulti=function(e){e=e||{};var t=new Ext.data.JsonStore({fields:e.fields||["id",e.displayField||"name"],autoLoad:!0,autoDestroy:!1,root:"results",url:e.url||PageBlocks.config.connectorUrl,baseParams:e.baseParams||{}});Ext.applyIf(e,{xtype:"superboxselect",store:t,displayField:e.displayField||"name",valueField:"id",triggerAction:"all",extraItemCls:"x-tag",expandBtnCls:"x-form-trigger",clearBtnCls:"x-form-trigger",renderTo:Ext.getBody(),mode:"remote",pageSize:10}),e.name+="[]",e.hiddenName=e.name,PageBlocks.combo.GetListMulti.superclass.constructor.call(this,e),setTimeout(()=>{e.store.load({params:{limit:e.pageSize}})},1e3)},Ext.extend(PageBlocks.combo.GetListMulti,Ext.ux.form.SuperBoxSelect),Ext.reg("pb-combo-getlist-multiple",PageBlocks.combo.GetListMulti);