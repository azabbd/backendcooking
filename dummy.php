 
<html> 
<?php include ('sessioninclude.php'); ?>
    <head>
        <title>Demo</title>
    </head>
    <body>
    <div class="wrapper">
    <form name="newItem" id="newItem">
    <input type="text" class="text_field" id="task" placeholder="Write a new task here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write a new task here...'" />
    <input type="button" id="addItem" class="add_btn" value="Add" />
    </form>
    <div class="items">
        <ul id="tasks" class="sortable">
            
        </ul>
    </div>
</div>

    </body>
</html><script>
    $("#addItem").click(function(){
        var task = $('#task').val();
        $("#tasks").append("<li>"+ task + " <input   type='checkbox' /> </li>");
      });

     $("#newItem").on('submit',function(e){                 
       //add stuff to database if necessary
         e.preventDefault();
         return false;
      });
</script>