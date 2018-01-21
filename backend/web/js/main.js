/**
 * Created by Administrator on 2018/1/19.
 */
$(function(){

   //$('.tags_list_view').val();


    function tagsList(pid, target,divId) {
        if(!target){
            return;
        }
        var pid = pid;
        var target = $(target);

        function getList(pid, callback) {
            var tagsList = $(divId);
            if(!tagsList.length){
                return;
            }
            $.getJSON(tagsList.data('url'),{pid : pid},  function (data) {
                data.forEach(function (v, i) {
                    // console.log(i,v)
                    // main.js:16 {id: "1", name: "购物", pid: "0", path: ""}id: "1"name: "购物"path: ""pid: "0"__proto__: Object 0
                    callback(v);
                })
            })
        }

        function createList(pid, parent) {
            if(!parent.jQuery){
                parent = $(parent);
            }
            parent.empty();
            var option =  document.createElement('option')
            option.setAttribute('value', '-1')
            option.setAttribute('data-pid', '')
            option.setAttribute('data-path', '')
            option.appendChild(document.createTextNode('全部'))
            parent.append(option);
            getList(pid, function (v) {
                var option =  document.createElement('option')
                option.setAttribute('value', v.id)
                option.setAttribute('data-pid', v.pid)
                option.setAttribute('data-path', v.path)
                option.appendChild(document.createTextNode(v.name))
                parent.append(option)
            });
        }

        createList(pid, target);

        target.on('click', 'option', function () {
            var pid = this.value;
            if(pid > -1){
                var nextTagList = target.data('next-tag-list');
                target.nextTagList = new tagsList(pid, '.'+ nextTagList, divId);
            }
        })

        target.getNextTagList = function () {
            return target.nextTagList ?  target.nextTagList : false;
        }

        return target;
    }

    function initTagsSelectorList() {
        var list = [];

        var divId = '#tagsList';
        var selectorTarRow = $('#phones-tags').parent();
        var row = $('<div class=" form-group "><div class="col-sm-12"></div></div>').insertAfter(divId);
        var button = $('<button type="button" class="btn btn-default ">添加</button>');
        button.appendTo(row.children());
        var _tagsList = new tagsList(0, '.list-tags-one', divId);
        button.click(function () {
            var tag = getSelectorTags(_tagsList);
            addTag(tag, selectorTarRow);
        });
        
        function addTag(tag, selectorTarRow) {
            console.log(tag)
            var id = tag.val();
            var path = tag.data('path');
            var _idList  = path.split('_');
            _idList.push(id);
            _idList.forEach(function (id) {
                if(id && list.indexOf(id) == -1){
                    list.push(id);
                    var bt = createTag(tag);
                    bt.appendTo(selectorTarRow);
                }
            });
        }
        
        function createTag(tag) {
            var id = tag.val();
            var bt = '<div class="col-sm-2">' +
                '<div id="tag ' + id + ' " style="padding: 0px;margin-bottom: 4px;" class="alert fade in" role="alert">\n' +
                '        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>\n' +
               tag.text() +
                '    </div></div>';

            return $(bt);
        }
        
        function removeTag(id) {
            $('#tag' + id).remove();
        }


        function getSelectorTags(tagsList) {
            var _tagsList = tagsList.getNextTagList();
            if(!_tagsList){
                var option = tagsList.find('option:selected');
                return option.val() == -1 ? false : option;
            }
            return getSelectorTags(_tagsList);
        }
    }

    initTagsSelectorList()




});

