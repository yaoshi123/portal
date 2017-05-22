$(function(){
    $('#quit').click(function(){
        if(confirm('确认退出？')){
            window.location.href='/index/quit'
        }
    })
})
