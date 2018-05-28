<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.css">
    <title>TO DO LIST</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <?php
        include "TList.php";
        include "ButtonControl.php";
        $TicketList = new TList;
    ?>

    <div class="container">
        <div class="jumbotron text-center">
            <h2>Simple PHP Todo App 
                <span class="label label-info">
                    <?php echo $TicketList->getCountList() ?>
                </span>
            </h2>
        </div>

        <form method="POST">
            <div id="todo-list" class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="checkbox">
                            <?php
                                for ($i = 0; $i < $TicketList->getCountList(); $i++) {
                                    $Ticket = $TicketList->getTicketById($i);
                                    echo '<input type="checkbox" name="checks[]" value='.$i.'>' . 
                                    $Ticket->getText() . "<br>";
                                }
                            ?>
                    </div>

                </div>
            </div>
            <div id="todo-form" class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg text-center" placeholder="I want to do something!" name="textTask">
                        </div> 
                        <button type="submit" class="btn btn-success btn-lg" name="CreateNewTask">Create</button>
                        <button type="submit" class="btn btn-primary btn-lg" name="UpdateCorrectTask">Update</button>
                        <button type="submit" class="btn btn-danger btn-lg" name="DeleteTasks">Delete</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>