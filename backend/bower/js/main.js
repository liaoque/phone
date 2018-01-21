/**
 * Created by Administrator on 2018/1/19.
 */
$(function(){

   //$('.tags_list_view').val();


    function tagsList(pid, target) {
        if(!target){
            return;
        }
        var pid = pid;
        var target = $(target);

        function getList(pid, callback) {
            var tagsList = $('#tagsList');
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

        target.on('change', 'option', function () {
            var pid = this.value;
            var nextTagList = parent.data('next-tag-list');
            new tagsList(pid, nextTagList);


        })
    }

   new tagsList(0, '.list-tags-one');



});

