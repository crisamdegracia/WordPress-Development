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

        if( currentLikeBox.data('exists') == 'yes'){
            this.deleteLike(currentLikeBox);
        } else {

            /* pass the variable here to the function - so the function can use it*/
            this.createLike(currentLikeBox)
        }

    }

    /*
        currentLikeBox - is a parameter from ourclickDispatcher
            - the name can be any

        */
    deleteLike(currentLikeBox){

        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'DELETE',
            success: (response)=>{
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