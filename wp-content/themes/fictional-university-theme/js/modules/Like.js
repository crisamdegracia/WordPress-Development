import $ from 'jquery';



/*
f20v88
*/
class Like {

    constructor(){

        this.events();
    }



    events(){
        $('.like-box').on('click', this.ourClickDispatcher.bind(this));
    }

    ourClickDispatcher(e){

        /*
          $(e.target).closest('className') - when someone clicks on the like box they 
                    might not actually click on the overall grey box itself
                    they might click on the heart icon or the little number
                    - with this whatever element user clicks find the closest ancestor,
                    meaning parent or grandparent that matches this selector
                    - this line of code will guarantee that this variable will always be pointing towards the relevant like box
                    
                    
        */
        var currentLikeBox = $(e.target.closest('.like-box'));

        if( currentLikeBox.attr('data-exists') == 'yes'){
            this.deleteLike(currentLikeBox);
        } else {

            /* pass the variable here to the function - so the function can use it*/
            this.createLike(currentLikeBox)
        }

    }

    /*
        beforeSend: (xhr)=> {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce  )
            - Create Nonce so the server will allow us to delete data
            
        currentLikeBox - is a parameter from ourclickDispatcher
            - the name can be any
            
            we set this so we can tell this DELETE ajax what we want to delete
            data:{like} - this is the property that we can send to the server
                        - so we need an id number that we want to delete
            
            - on success we duplicate the createLike function and binaliktad natin ung function
            
            currentLikeBox.attr('data-like', '' ); - we set data-like to empty - this is the ID
                
    */
    deleteLike(currentLikeBox){

        $.ajax({
            beforeSend: (xhr)=> {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce  )
            },
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            data: {'like': currentLikeBox.attr('data-like') },
            type: 'DELETE',
            success: (response)=>{
                   currentLikeBox.attr('data-exists','no');
                var likeCount = parseInt(currentLikeBox.find('.like-count').html(), 10 );
                likeCount--;
                currentLikeBox.find('.like-count').html(likeCount);
                currentLikeBox.attr('data-like', '' );
                console.log(response)
            },
            error: (response)=> {
                console.log(response)
            },
        })
    }

    /*
    CREATE NONCE - to validate user if logged to use like function
    URL - the one we set in /inc/like.php 
       TYPE - type of request
       we get the ID in front-end on data-professor then use it here on AJAX then we pass it to PHP

       currentLikeBox - is the variable pass a parameter from clickDispatcher() - name can be any
       so we can use it here below
       data: {'professorId': currentLikeBox.data('professor')},
                
        currentLikeBox.attr('data-exist','yes') - so we can change the value on HTML
            - to change the heart on the fly
        var likeCount = parseInt(currentLikeBox.find('.like-count').html()); 
            - this variable is the current number of like
            - parseInt(2 args = 1st - the string of text we want to convert , 2nd - 10) - sabi nya base of 10 daw
            - after setting variable - we convert into number then, increament, then  output in on front-end
            
        currentLikeBox.attr('data-like', response );
            - response - coz if we succesfully create a like post the WP server
            sends back the ID number of that new post that will be the response 
    */
    createLike(currentLikeBox) {
        $.ajax({
            beforeSend: (xhr)=> {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce  )
            },
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'POST',
            data: {'professorId': currentLikeBox.data('professor')},
            success: (response)=>{
                currentLikeBox.attr('data-exists','yes');
                var likeCount = parseInt(currentLikeBox.find('.like-count').html(), 10 );
                likeCount++;
                currentLikeBox.find('.like-count').html(likeCount);
                currentLikeBox.attr('data-like', response );
                console.log(response)
            },
            error: (response)=> {
                console.log(response)
            },
        })

    }

}


//name of main class 
// so we can use it anywhere
export default Like;