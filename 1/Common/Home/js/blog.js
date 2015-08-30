/*加载更多文章*/
function loadArticle(url,flag,num){
	$.ajax({
		type:'post',
		url:url,
		data:{flag:flag,offset:num},
		dataType:'json',
		success:function(data){
			if(data == ''){
				$('#rui-prompt').text("暂无更多内容").fadeIn();
				setTimeout(function(){$('#rui-prompt').fadeOut();},5000);
			}
			else{
				$.each(data,function(k,v){
					$item = $("<div><h2 class='entry-title'><a href='"+v.arcurl+"' title='"+v.title+"'>"+v.title+"</a></h2><div class='entry-meta entry-header'><span class='contentinfo_time'>"+v.createtime+"</span><span class='contentinfo_category'><a href='"+v.colurl+"' title='查看 "+v.colname+" 中的全部文章'>"+v.colname+"</a></span><span class='contentinfo_view'>"+v.click+"次点击</span><span class='contentinfo_comment'>"+v.commentnum+"条评论</span></div><div class='post-thumb post-lead'>"+getPic(v)+"</div><div class='entry-content'><p>"+v.description+"...</p><p><a href='"+v.arcurl+"' class='more-link'>阅读全文 »</a></p></div></div>").hide();
					$('#primary').append($item);
					$item.fadeIn();
				});
				//重新绑定事件
				$('.entry-title a,.more-link').hover(function() { 
					$(this).stop().animate({'marginLeft': '10px'}, 200); 
					}, function() { 
					$(this).stop().animate({'marginLeft': '0px'}, 400); 
				}); 
				$('.entry-title a').click(function(e) {
					e.preventDefault();
					var htm = 'Loading',
					i = 4,
					t = $(this).html(htm).unbind('click'); (function ct() {
						i < 0 ? (i = 4, t.html(htm), ct()) : (t[0].innerHTML += '.', i--, setTimeout(ct, 150))
					})();
					window.location = this.href
				});
			}
		}
	});
}
function getPic(v){
	if(v.pic == ''){
		return '';
	}
	else{
		var pic = "<a href='"+v.arcurl+"' title='"+v.title+"'><img width='570' height='140' src='"+v.pic+"' class='attachment-archive-thumb wp-post-image' alt='"+v.title+"' /></a>";
		return pic;
	}
}