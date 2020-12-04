function sortTable(columnNumber, tableID) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById(tableID);
  switching = true;
  // This code was copied from w3schools.
  // Set the sorting direction to ascending:
  dir = "asc";
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[columnNumber];
      y = rows[i + 1].getElementsByTagName("TD")[columnNumber];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function randomColours(numCol) {
  let colourArray = [], j = 0;
  let colours = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f"];
  while (j < numCol) {
    let tempArray = []
    for (var i = 0; i < 6; i++) {
      let rand = colours[Math.floor(Math.random() * 16)];
      tempArray.push(rand);
    }
    colour = "#" + tempArray.join("");
    colourArray.push(colour);
    j++;
  }
  return colourArray;
}

function randomColours(numberOfColours) {
  let colourArray = [], jIndex = 0;
  const colours = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f"];
  while (jIndex < numberOfColours) {
    let colour = '#';
    for (let index = 0; index < 6; index++) {
      colour += colours[Math.floor(Math.random() * 16)];
    }
    colourArray.push(colour);
    jIndex++;
  }
  return colourArray;
}

function tableFilter(requestTable, searchInput) {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById(searchInput);
  filter = input.value.toUpperCase();
  table = document.getElementById(requestTable);
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

$(function () {
  // A variable to hold the button clicked.
  var buttonclicked;

  // randomise();
  // alert(randomColours(6));

  // Scroll to top button appear
  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function (event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    event.preventDefault();
  });

  $('#user_name').on('blur', function () {
    let username = $('#user_name').val();
    if (username != '') {
      $.ajax({
        type: "GET",
        url: "data_processor.php",
        data: "flag=getUser&choice=" + username,
        success: function (data) {
          var myjson = data;
          var myobj = JSON.parse(myjson);

          let status = myobj.status;
          if (status == 'taken') {
            $('#status').html('<ul><li>Username already exists. Please create a new username!</li></ul>');
            $('#_user_').attr('disabled', true);
          } else {
            $('#status').text('');
            $('#_user_').attr('disabled', false);
          }
        }
      })
    } else {
      $('#status').text('');
      $('#_user_').attr('disabled', false);
    }
  });

  $('#opass').on('blur', function () {
    let user_name = $('#uname').val();
    let password = $('#opass').val();
    // alert(password +"-"+user_name);
    if (user_name != '' && password != '') {
      $.ajax({
        type: "GET",
        url: "data_processor.php",
        data: "flag=getPassword&choice=" + user_name + "&password=" + password,
        success: function (data) {
          var myjson = data;
          var myobj = JSON.parse(myjson);

          let status = myobj.status;
          if (status == 'unmatch') {
            $('#oldpass').html('<ul><li>Incorrect old password! Please type the correct old password.</li></ul>');
            $('#_user_').attr('disabled', true);
          } else {
            $('#oldpass').text('');
            $('#_user_').attr('disabled', false);
          }
        }
      })
    } else {
      $('#oldpass').text('');
      $('#_user_').attr('disabled', false);
    }
  });

  $('#complete, #pending').click(function () {
    if (this.id == 'complete') {
      buttonclicked = $('#complete').val();
    } else if (this.id == 'pending') {
      buttonclicked = $('#pending').val();
    }
  });

  $('#reportForm').on('submit', function (e) {
    e.preventDefault();

    let value = buttonclicked;
    $.ajax({
      url: "__request__.php",
      method: "POST",
      data: $('#reportForm').serialize() + "&dType=json&make_request=" + value,
      type: 'json',
      success: function (data) {
        let myjson = data;
        let myobj = JSON.parse(myjson);

        let state = myobj.status;
        $('#reportModal').modal('hide');
        if (state == 'pending') {
          window.location.href = 'address_issue.php?reqid=' + myobj.id;
        }
      }
    });
  });

  $('#analyticsForm').on('submit', function (e) {
    e.preventDefault();
    let graph = $('#graph_type').val().toLowerCase().trim();
    let status = $('#analytics_type').val().trim();

    $.ajax({
      url: "data_processor.php",
      method: "POST",
      data: $('#analyticsForm').serialize() + "&flag=getAnalytics",
      type: 'json',
      success: function (data) {
        let myobj = JSON.parse(data);

        let label = [], value = [];

        for (let i in myobj) {
          if (i != 'graph') {
            for (let j in myobj[i]) {
              if (j == 'label') {
                label.push(myobj[i][j]);
              } else {
                value.push(myobj[i][j]);
              }
            }
          }
        }

        var ctx = document.getElementById("graphCanvas").getContext("2d");
        let datalength = label.length, backColor, borderColor;

        // Get the appropraite colouring for a graph
        if (['pie', 'doughnut'].includes(graph)) {
          backColor = randomColours(datalength);
          borderColor = 'white';
        } else if (graph == 'line') {
          backColor = "rgba(0,0,0,0)";
          borderColor = "rgba(2,117,216,1)";
        } else {
          backColor = "rgba(2,117,216,1)";
          borderColor = "rgba(2,117,216,1)";
        }

        var chartdata = {
          labels: label,
          datasets: [{
            label: 'Student Marks',
            backgroundColor: backColor,
            borderColor: borderColor,
            data: value
          }]
        };

        if (window.bar != undefined) {
          window.bar.destroy();
        }

        window.bar = new Chart(ctx, {
          type: graph,
          data: chartdata,
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  min: 0,
                }
              }]
            },
            legend: {
              position: 'left'
            }
          }
        });

        // alert(label);
      }
    });
  });

  $('#dataTable').DataTable({
    'ordering': false
  });
  $('#request_brand').editableSelect({
    filter: true,
    effects: 'fade'
  });
  $('#request_component').editableSelect({
    filter: true,
    effects: 'slide'
  });
  $('#request_category').editableSelect({
    filter: true,
    effects: 'slide'
  });
  $('#analytics_type').editableSelect({
    filter: false,
    effects: 'slide'
  });
  $('#graph_type').editableSelect({
    filter: false,
    effects: 'slide'
  });
  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function ($form, event, errors) {
      // $('#myModal').modal();
      alert('it appears you some issues with your form.')
    },
  });
  $(".item").hover(function () {
    $(".cat-border").each(function () {
      $(this).css("z-index", "1");
    })

    $(".cat-border").hover(function () {
      $(this).css("z-index", "2");
    })
  });
});
