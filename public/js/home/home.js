var home = {
    groupid:0,
    baseurl:0,
    userid:0,
    avatar:0,
    updatePosts: function () {
        $.post(home.baseurl+"dashboard/ajaxUpdatePosts",{'groupid':home.groupid},function (data) {
            $("#post_list").html(data);
               console.log(data);
            },'json'
        );
    },
    init: function () {
        home.groupid = $('#groupid').val();
        home.baseurl = $('#baseurl').val();
        home.userid = $('#userid').val();
        home.avatar = $('#avatar').val();

        $('form').submit(function () {
            var baseurl = $('#baseurl').val();
            $.post(baseurl+"dashboard/ajaxAddPost",{'formdata':$('form').serialize()},function (data) {

                var html =  '<div class="row nopadding" id="post-container" style="width: 100%;min-height: 50%;"> ' +
                                '<div class="col-sm-2 black-borded text-info text-center" style="padding: 25px;border-bottom:none"> ' +
                                    '<a href="'+baseurl+'dashboard/user/'+data["userid"]+'">\n\
                                     <img src="'+home.baseurl+home.avatar+'"  class="img-fluid" alt="Cinque Terre">\n\
                                     </a>\n\
                                     <p class="font-weight-bold"><h5 class="btn-responsive">'+data['firstname']+" "+data['lastname']+ '</h5></p> \n\
                                </div> ' +
                                '<div class="col-sm-10 black-borded" style="padding: 25px 50px; border-left:none;border-right:none;border-bottom:none"> \n\
                                      <div class="row"> ' +
                                          '<div class="col-sm-7" style="word-wrap: break-word">\n\
                                                  <div class="row"><h4>'+data['text']+'</h4></div> ' +
                                                 '<div class="row smallmargin">\n\
                                                        <div class="col-sm-9"> ' +
                                                             '<textarea class="form-control reply-text-'+data['id']+'" placeholder="Reply...." name="text" rows="4" id="text" style=""></textarea>\n\
                                                        </div> ' +
                                                        '<div class="col-sm-1"> <button postid="'+data['id']+'" class="forumPostButton btn btn-default reply">Reply</button></div>\n\
                                          </div> </div> ' +
                                '<div class="col-sm-5 col-replies-'+data['id']+'" style="word-wrap: break-word"></div> </div> </div> </div>';



                    $('#text').val('');
                $("#post_list").prepend(html);
                },'json'
            );

            return false;
        });

        $(document).on("click",".reply", function(){

            var postid = $(this).attr('postid');
            var text = $('textarea.reply-text-'+postid).val();
            var userid = $('#userid').val();
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var baseurl = $('#baseurl').val();
            $.post(baseurl+"dashboard/ajaxAddReply",{'postid':postid,'text':text},function (data) {


                },'json'
            );
            var html = '<div class="row smallmargin"></div>' +
                '<div class="row">' +
                '<div class="col-sm-3">\n\
                   <a href="'+baseurl+'dashboard/user/'+userid+'"> <img src="'+baseurl+home.avatar+'"  class="img-fluid" alt="' + firstname + ' ' + lastname + '"></a>\n\
                    </div>' +
                '<div class="col-sm-7  black-borded">'+text+'</div>' +
                '<div class="col-sm-2 ">' +
                '</div>';

            $('textarea.reply-text-'+postid).val('');
            $('.col-replies-'+postid).append(html);
        });

       $(document).on("click",".like-reply", function(){

            var replyid = $(this).attr('replyid');
            var liked = $(this).attr('liked');

            if(liked == 'true'){
                var url = home.baseurl+"dashboard/ajaxRemoveLike";
            }
            else{
                var url = home.baseurl+"dashboard/ajaxAddLike";
            }

            $.post(url,{'replyid':replyid,'userid':home.userid},function (data) {



                },'json'
            );
           if(liked == 'true'){
               $('#like-reply-'+replyid).attr('liked','false');
               $('#like-reply-'+replyid).find('svg').attr('data-prefix',"far");
           }
           else{
               $('#like-reply-'+replyid).attr('liked','true');
               $('#like-reply-'+replyid).find('svg').attr('data-prefix',"fas");
           }
        });


      //  setInterval(this.updatePosts, 10000);

    }
};

$( document ).ready(function() {
    home.init();
});