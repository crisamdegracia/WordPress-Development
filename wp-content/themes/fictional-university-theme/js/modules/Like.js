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
            this.deleteLike();
        } else {
            this.createLike()
        }

    }


    deleteLike(){

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

    /* URL - the one we set in /inc/like.php 
       TYPE - type of request
    */
    createLike() {
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'POST',
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