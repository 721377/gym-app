const menu = document.getElementById("menu");
const navb = document.getElementById("nav-bar");

navb.style.width = "18%";
   
    menu.onclick = function(){


        if( navb.style.width =="18%") {
            navb.style.width = "5%";
            
        }
        else{
            navb.style.width = "18%";
        }
    }

    const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
      ];
    
      const data = {
        labels: labels,
        datasets: [{
          label: 'gains mensuels',
          fill: true,
          backgroundColor: '#91accb',
          borderColor: '#eafadd',
          pointBackgroundColor: '#f9f9f9',
          data: [0, 10, 5, 2, 20, 30, 45],
        }]
      };
    
      const config = {
        type: 'line',
        data: data,
        
        options: {
            radius: 5,
            responsive: true,
        }
      };
   
  
      const myChart = new Chart(
        document.getElementById('myChart').getContext("2d"),
        config
        
      );




const add =  document.getElementById("add");
const x =  document.getElementById("close");
const form =  document.getElementById("form");
form.style.top = '-100%';
add.onclick = function(){
   if(form.style.top == '-100%'){
    form.style.top = '0';
   }

}
x.onclick = function(){
    form.style.top = '-100%';
   }

   


   
