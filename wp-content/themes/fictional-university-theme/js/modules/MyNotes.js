/*before we use Jquery we need to set this*/ 

import $ from 'jquery';



class MyNotes{

    /* constructor  is the trigger */
    constructor(){


        this.events();

    }


    events(){

        $('.delete-note').on('click',  this.deleteNote ); 
        $('.edit-note').on('click',  this.editNote ); 

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
           },
           error: (response) => {
               console.log('Error meneee');
             console.log(response);  
           }
       });
    }
    
    /* find the edit button and remove readonly attribute */
      editNote(e){
          
          var editNote = $(e.target).parents('li');
          
          editNote.find('.note-title-field, .note-body-field').removeAttr('readonly').addClass('note-active-field');
          editNote.find('.update-note').addClass('update-note--visible');
      }
}


/* name of class above*/
export default MyNotes;