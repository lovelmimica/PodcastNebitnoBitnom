addLoadEvent(()=>{var filterPosts=()=>{let episodeListWrapper=document.querySelector(".episode-list");episodeListWrapper.style.opacity='0.5';let includedPosts=localStorage.getItem('includedPosts');let posts=document.querySelectorAll("body.elementor-page-141 div.elementor-posts > article.elementor-post");if(includedPosts){includedPosts=includedPosts.split(",");if(Array.isArray(includedPosts)&&includedPosts.length>0){posts.forEach(post=>{postId=post.id.slice(5);if(includedPosts.includes(postId))post.style.display="block";else post.style.display="none";});}}else if(includedPosts!==null){posts.forEach(post=>{post.style.display="none";});}
episodeListWrapper.style.opacity='1';}
if(document.referrer!="http://nebitno-o-bitnom.com/epizode/"){localStorage.removeItem("includedPosts");}
filterPosts();let form=document.querySelector("#episode_filter_form");if(form){form.addEventListener("change",(event)=>{let hostNodes=document.querySelectorAll("#episode_filter_form .elementor-field-group-episode_filter_form__hosts input");let hosts=[];for(let i=0;i<hostNodes.length;i++){if(hostNodes[i].checked===true)hosts.push(hostNodes[i].value);}
let tagNodes=document.querySelectorAll("#episode_filter_form .elementor-field-type-topic_tags input");let tags=[];for(let i=0;i<tagNodes.length;i++){if(tagNodes[i].checked===true)tags.push(tagNodes[i].value);}
let url="https://nebitno-o-bitnom.com/wp-json/post-filter/v1/do-filter?";for(let i=0;i<hosts.length;i++){url=url.concat("hosts[]="+hosts[i]+"&");}
for(let i=0;i<tags.length;i++){url=url.concat("tags[]="+tags[i]+"&");}
if(url.slice(-1)=="&"||url.slice(-1)=="?")url=url.slice(0,-1);fetch(url).then(response=>response.json()).then(data=>{localStorage.setItem('includedPosts',data.filtered_posts);filterPosts();});});let selectedTag=localStorage.getItem("selectedTag");if(selectedTag){let checkboxOption=document.querySelector("#episode_filter_form .elementor-field-type-topic_tags input[value='"+selectedTag+"']");if(checkboxOption){checkboxOption.checked=true;let changeEvent=new Event("change");form.dispatchEvent(changeEvent);}}
localStorage.removeItem("selectedTag");}
let tags=document.querySelectorAll(".elementor-post-info__item--type-custom > a[rel='tag']");if(tags){tags.forEach(tag=>{tag.addEventListener("click",event=>{event.preventDefault();let selectedTag=event.target.textContent;if(window.location.href=="https://nebitno-o-bitnom.com/epizode/"){let checkboxOption=document.querySelector("#episode_filter_form .elementor-field-type-topic_tags input[value='"+selectedTag+"']");if(checkboxOption){checkboxOption.checked=true;let changeEvent=new Event("change");form.dispatchEvent(changeEvent);}}else{localStorage.setItem("selectedTag",selectedTag);window.location.href="https://nebitno-o-bitnom.com/epizode/";}});});}});