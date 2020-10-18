/*before we use Jquery we need to set this*/ 

import $ from 'jquery';



class MyNotes{

    /* constructor  is the trigger */
    constructor(){


        this.events();

    }

        
        /*.bind.this() whithout this daw JS will modify the value of this 
        and set to equal to whatever element AHA! */

/*  $('.delete-note').on('click',  this.deleteNote ); - sa pag load ng document ung current post lang ung nasa DOM, so kapag nag update/create using this class button
            e hindi pa nailagay  opr naset ni JS sa DOM. to fix this
            1st is - $('#my-notes').on('click', ".delete-note", this.deleteNote )
                - so ngayon mag hahanap sya sa child element nalng. */
    events(){
        $('#my-notes').on('click', '.delete-note',  this.deleteNote ); 
        $('#my-notes').on('click', '.edit-note', this.editNote.bind(this) ); 
        $('#my-notes').on('click', '.update-note', this.updateNote.bind(this)); 
        $('.submit-note').on('click', this.createNote.bind(this)); 
        

    }



    //methods

    /*
           xhr - so we can send a parameter to modify request jquery to send out
           beforeSend: (xhr) 

           all modern browser have a method name setRequestHeader
           setRequestHeader - is how we can pass along a little bit of extra information with your request
            setRequestHeader() - 1st arg, need to be perfect match what wordpress is going to lookout for - X-WP-Nonce
            setRequestHeader() - 2nd arg - is the secrret number

            to get the ID from input field from the HTML part (pag-my-note.php)
            we need to give parameter on function deleteNote() - so (e) or event

            sabi daw. when we click the delete button, the event(){} will give us information so now we can use the (e) parameter


           */
    /*this variable will point list item on HTML that contains the delete button 
        so ang parent is 'li' -- so titingin sya sa mga children sa baba ng 'li'

        thisNote.data('id') - now we can access the data-id on HTML
        */


    deleteNote(e){


        var thisNote = $(e.target).parents('li');

        $.ajax({

            beforeSend: (xhr)=> {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce  )
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'DELETE',
            success: (response) => {

                thisNote.slideUp('slow');
                console.log('Congrats');  
                console.log(response);  
                
                if(response.userNoteCount < 5 ) {
                   $('.note-limit-message').removeClass('active') 
                }
            },
            error: (response) => {
                console.log('Error meneee');
                console.log(response);  
            }
        });
        
    }
    
    /*--- UPDATE ------- CRUD 
    1st - we just copy the delete method above
    2nd - we changed 'type' to POST
        - because we will send a POST request
    3rd - on success we will 1st call makeNoteReadOnly(); you get that yeah?   
        - make sure to pass the thisNote variable
    4th - we create a variable ourUpdatePost{}
        - the WordPres Rest API is looking for a specific property name
        -  so if we want to update the title,name 
        - we need to get the value in the front-end, this is the data that we will send as POST
    5th - now we can set the data:ourUpdatePost 
    */
    
    
    updateNote(e){

       var thisNote = $(e.target).parents('li'),
            ourUpdatePost = {
                'title':    thisNote.find('.note-title-field').val(),
                'content':  thisNote.find('.note-body-field').val()
            };
        
        
        
        $.ajax({

            beforeSend: (xhr)=> {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce  )
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'POST',
            data: ourUpdatePost,
            success: (response) => {
                this.makeNoteReadOnly(thisNote);
                console.log('Congrats');  
                console.log(response);
                
                thisNote.find('.alert-message').addClass('alert-visible').html('Edit Successful!');
                
            },
            error: (response) => {
                console.log('Error meneee');
                console.log(response);  
            }
        });
        
        
    }
    
    /*UPDATE-----------------*/
    /*
    To submit our newly created note
    
    'status' - default value is 'draft' so we need to set it 'publish'
    title - get the user input. same as on content
    
     url: universityData.root_url + '/wp-json/wp/v2/note/',
        - if we include the ID at the end of URL 
        - WP will inerpret that we want to work on the current post
        - if we want to create different post /wp-json/wp/v2/posts or pages/ just change 
        that
        
        
        
         $('.new-note-title, .new-note-body').val('');  -- early in the video - he sets the value empty
         
         
         success: (response) => - we can try to console.log that to see the value we can use
            - ${response.title.raw} - 
            - ${response.id}
         
         
            $('.delete-note').on('click',  this.deleteNote ); - sa pag load ng document ung current post lang ung nasa DOM, so kapag nag update/create using this class button
            e hindi pa nailagay  or naset ni JS sa DOM. to fix this
            1st is - $('#my-notes').on('click', ".delete-note", this.deleteNote )
                - so ngayon mag hahanap sya sa child element nalng. 
            
         the button for EDIT and DELETE will not work when we submit this note
                - the script never set up event listers for these buttons. to fix this
    */
      createNote(e){

       var  ourNewPost = {
                'title':    $('.new-note-title').val(),
                'content':  $('.new-note-body').val(), 
                'status':   'publish'
            };
        
        
        
        $.ajax({

            beforeSend: (xhr)=> {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce  )
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/',
            type: 'POST',
            data: ourNewPost,
            success: (response) => {
                
                $('.new-note-title, .new-note-body').val('');
                $(`
                        <li data-id="${response.id}">
            <input readonly class="note-title-field" value="${response.title.raw}">
            <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
            <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
            <textarea readonly class="note-body-field" name="" id="" cols="100" rows="10"> ${response.content.raw} </textarea>

            <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right -o" aria-hidden="true"></i> Save </span>
        </li>

        
                `).prependTo('#my-notes').hide().slideDown();
                console.log('Congrats');  
                console.log(response);
                $('#alert').slideDown(500, ()=> {
                    $('#alert').addClass('alert-visible');
                    $('#alert').removeClass('alert-hidden');
                    
                }).slideToggle(900, () => {
                    $('#alert').removeClass('alert-visible');
                    $('#alert').addClass('alert-hidden');
                })
            },
            error: (response) => {
                if( response.responseText ){
                    /* if response Text has value then do this */
                   $('.note-limit-message').addClass('active')
                   }
                console.log('Error meneee');
                console.log(response);  
            }
        });
        
        
    }
    
    /*UPDATE-----------------*/
    
    
    

    /* 
    find the edit button and remove readonly attribute. 
    we copy the html on HTML file of the fontawesome to toggle the edit to cancel.


    */

    editNote(e){
        /* steps
        1st we declare the button
        2nd we decalre the Event parameter
        3rd we create 2 methods makeEditable and makeReadOnly
        4th we create the logic and conditions
        */
        var editNote = $(e.target).parents('li');

        
        /* [code This.Note]
        let see if the note has an attribute named state 
        and if it equals editable 
        
        there is no magical about word STATE or EDITABLE
        I made up both those terms daw. he just declare it earlier, before he explains 
        why he did it.
         
        he is checking for data-atrribute within the parent list item and
        checking for a specific value. but when we 1st visit the page. there is no value
        like this. withe attribut data-state=editable
        thats why when we 1st click the button it will evaluate to false
        so the else wil run which will able us to edit
        */
        if(editNote.data('state') == 'editable'){
            
            /*in order daw to reference our methods this.methodName we want to make sure
            that the keyword 'this' is pointing towards our main class object ( the main class object is MyNotes() the of all! )
            then we need to look to our events() handler.
            
            $('.edit-note').on('click',  this.editNote ).bind(this); 
            so when edit note gets clicked this is what we're going to call
            and response we want to be sure. thats why we need to add .bind(this);
            otherwise the JS will modify the value of this and set it equal to whatever element we clicked on
            
            when we 1st create the variable editNote, it will exist inside of this method
            v80 10:33 mins. this.makeNoteReadOnly(editNote); <-- he explains this but not clear he just add the parameter (editNote)
            */
            this.makeNoteReadOnly(editNote);
        } else {
            this.makeNoteEditable(editNote);
        }



    }  


    /*----- Toggle Edit Cancel ----------*/
    makeNoteEditable(editNote){
        /* Add Classes*/
        
        editNote.find('.edit-note').html('<i class="fa fa-times" aria-hidden="true"></i> Cancel');
        
        editNote.find('.note-title-field, .note-body-field').removeAttr('readonly').addClass('note-active-field');
        
        editNote.find('.update-note').addClass('update-note--visible');
        
        /* 
        this will be added when we click cancel button. read mo [code This.Note]
        */
        editNote.data('state', 'editable');
        
    }


    makeNoteReadOnly(editNote){
        /* Remove Classes*/
        editNote.find('.edit-note').html('<i class="fa fa-pencil" aria-hidden="true"></i> Edit');

        /* attr 2 args - 1st name of attribute. 2nd is the value that we want to assign.   */
        editNote.find('.note-title-field, .note-body-field').attr('readonly','readonly').removeClass('note-active-field');
        editNote.find('.update-note').removeClass('update-note--visible');
        
        /* we want to update the data-attribute to cancel but the name cancel is not so important, we just need it be be a different attribute name */
        editNote.data('state', 'cancel')
    }
    /*----- Toggle Edit Cancel ----------*/
    
    

   
}


/* name of class above*/
export default MyNotes;