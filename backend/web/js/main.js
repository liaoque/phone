/**
 * Created by Administrator on 2018/1/19.
 */
$(function () {

    //$('.tags_list_view').val();


    function tagsList(pid, targetId, divId) {
        if (!targetId) {
            return;
        }
        var pid = pid;
        var _target = document.querySelector(targetId);
        var target = _target[targetId] ? _target[targetId] : (_target[targetId] = $(_target));

        function getList(pid, callback) {
            var tagsList = $(divId);
            if (!tagsList.length) {
                return;
            }
            $.getJSON(tagsList.data('url'), {pid: pid}, function (data) {
                data.forEach(function (v, i) {
                    // console.log(i,v)
                    // main.js:16 {id: "1", name: "购物", pid: "0", path: ""}id: "1"name: "购物"path: ""pid: "0"__proto__: Object 0
                    callback(v);
                })
            })
        }

        function createList(pid, parent) {
            if (!parent.jQuery) {
                parent = $(parent);
            }
            parent.empty();
            var option = document.createElement('option')
            option.setAttribute('value', '-1')
            option.setAttribute('data-pid', '')
            option.setAttribute('data-path', '')
            option.appendChild(document.createTextNode('全部'))
            parent.append(option);
            getList(pid, function (v) {
                var option = document.createElement('option')
                option.setAttribute('value', v.id)
                option.setAttribute('data-pid', v.pid)
                option.setAttribute('data-path', v.path)
                option.appendChild(document.createTextNode(v.name))
                parent.append(option)
            });
        }

        createList(pid, target);

        if (!target.bindClicked) {
            target.on('click', 'option', function () {
                var pid = this.value;
                var nextTagList = target.data('next-tag-list');
                removeTags(target);
                if (pid > -1 && nextTagList) {
                    target.nextTagList = new tagsList(pid, '.' + nextTagList, divId);
                }
            });
            target.bindClicked = true;
        }

        function removeTags(target) {
            if(target.nextTagList){
                removeTags(target.nextTagList);
            }
            var nextTagList = target.data('next-tag-list');
            if(nextTagList){
                $('.' + nextTagList).children('option:first-child').siblings().remove();
            }
        }


        target.getNextTagList = function () {
            return target.nextTagList ? target.nextTagList : false;
        }

        return target;
    }

    function initTagsSelectorList() {
        var parentList = {};
        var childList = [];

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
            var id = tag.val();
            var pid = tag.data('pid');
            var path = tag.data('path');
            path += '_' + id;
            if (!inList(id, pid) && !inChildList(path)) {
                addList(path);
                childList.push(id);
                var bt = createTag(tag);
                bt.appendTo(selectorTarRow);
                setInput();
            }else if(inList(id, pid) && !inChildList(path)){
                confirm('您已经添加过该标签的子标签，是否要强制添加？（添加后，该标签下所有子标签都会绑定）', function () {
                    removeList(id, pid);
                    addList(path);
                    childList.push(id);
                    var bt = createTag(tag);
                    bt.appendTo(selectorTarRow);
                    setInput();
                });
            }else if(!inList(id, pid) && inChildList(path)){
                confirm('您已经添加过该标签的父标签，是否强制添加？（添加后，只有该标签会被绑定）', function () {
                    removeChildList(id);
                    addList(path);
                    childList.push(id);
                    var bt = createTag(tag);
                    bt.appendTo(selectorTarRow);
                    setInput();
                });
            }
        }

        function inList(id, pid) {
            return parentList[pid] && parentList[pid].indexOf(id) > -1;
        }

        function inChildList(path) {
            var flag = false;
            var _list = [];
            if (typeof path == 'string') {
                _list = path.split('_');
            } else {
                _list = path;
            }
            for (var i = 0; i < _list.length; i++) {
                if (childList.indexOf(_list[i]) > -1) {
                    flag = true;
                    break;
                }
            }
            return flag;
        }

        function removeChildList(id) {
            var index = childList.indexOf(id);
            if (index> -1) {
                childList.splice(index, 1);
            }
        }

        function addList(path) {
            var _list = [];
            if (typeof path == 'string') {
                _list = path.split('_');
            } else {
                _list = path;
            }
            _list.forEach(function (key, i) {
                if (i + 1 > _list.length) {
                    return;
                }
                var value = _list[i + 1];
                if (!parentList[key]) {
                    parentList[key] = [];
                }
                parentList[key].push(value);
            });
        }

        function removeList(id, pid) {
            if (parentList[id]) {
                parentList[id].forEach(function (t) {
                    return removeList(t, id);
                });
            }
            if (parentList[pid]) {
                var index = parentList[pid].indexOf(id);
                if (index > 0) {
                    parentList[pid].splice(index, 1);
                    removeTag(id);
                }
            }
            removeChildList(id);
        }


        function createTag(tag) {
            var id = tag.val();
            var pid = tag.data('pid');
            var bt = '<div class="col-sm-2">' +
                '<div id="tag' + id + '" style="padding: 0px;margin-bottom: 4px;" class="alert fade in" role="alert">\n' +
                '        <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">×</span></button>\n' +
                tag.text() +
                '    </div></div>';
            bt = $(bt);
            bt.children().on('close.bs.alert', function () {
                // do something…
                removeTag(id)
                removeList(id, pid);
                setInput();
            })
            return bt;
        }


        function setInput() {
            //吧值放进tags 表单里面
            var _tags = childList.sort().join(',');
            $('input[name="Phones[tags]"]').val(_tags);
        }

        function removeTag(id) {
            $('#tag' + id).parent().remove();
        }


        function getSelectorTags(tagsList) {
            var _tagsList = tagsList.getNextTagList();
            var result = false;
            if (_tagsList) {
                result = getSelectorTags(_tagsList);
            }
            if (!result) {
                var option = tagsList.children('option:selected');
                result = (!option.length || option.val() == -1) ? false : option;
            }
            return result;
        }
    }

    initTagsSelectorList()

    var _confirm = $('#confirm').on('show.bs.modal', function (e) {
        // do something...
        _confirm.find("#confirm-body").html(_confirm.message);
        _confirm.message = '';
    });
    _confirm.find('.btn-primary').on('click', function () {
        if(_confirm.callback ){
            _confirm.callback();
            _confirm.callback = null;
        }
        _confirm.modal('hide');
    });

    window.confirm = function (message, callback) {
        _confirm.message = message;
        _confirm.callback = callback;
        _confirm.modal('show');
    }

});

