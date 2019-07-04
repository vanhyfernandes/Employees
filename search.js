function loadXMLDoc(){
    document.getElementById("content").innerHTML = "";
    var element = document.getElementById("form").elements;
    var searchEmployee = element.item(0).value;

    var con = new XMLHttpRequest();
    con.open('GET','employees.xml',false);
    con.setRequestHeader("Content-Type", "text/xml");
    con.send(null);
    
    var xmlDoc = con.responseXML;
    var employees = xmlDoc.childNodes[0];

    var count = false;
    for (var i = 0; i < employees.children.length; i++)
    {
        var employee = employees.children[i];
        var item = employee.getElementsByTagName("lastname");
        var lastname = item[0].textContent.toString();
        
        var item = employee.getElementsByTagName("firstname");
        var firstname = item[0].textContent.toString();

        if(lastname == searchEmployee || firstname == searchEmployee){
            count = true;

            var id = employee.getElementsByTagName("employee_id");
            var email = employee.getElementsByTagName("email");
            
            addElementToElement("content",createLabel("ID: "+ id[0].textContent.toString()));
            addElementToElement("content",document.createElement('br'));
            addElementToElement("content",createLabel("Email: "+ email[0].textContent.toString()));
            addElementToElement("content",document.createElement('br'));
            addElementToElement("content",createLabel("First Name: "+ firstname));
            addElementToElement("content",document.createElement('br'));
            addElementToElement("content",createLabel("Last Name: "+ lastname));
            addElementToElement("content",document.createElement('br'));
            addElementToElement("content",document.createElement('br'));

        }
    }
    if(!count){
        addElementToElement("content",createLabel("First Name or Last Name not found!"));
    }
}

function addElementToElement(father, child){
    document.getElementById(father).appendChild(child);
}

function createLabel(text) {
    var element = document.createElement('label');
    var t = document.createTextNode(text);
    element.appendChild(t);
    return element;
}

