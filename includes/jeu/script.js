
var grille = [];
var butts = [];
var coups =  [];

function init()
{
		for(var i = 0; i < 81;i++)
		{
			grille[i] = 0;
			butts[i] = document.getElementById(i);

			butts[i].onclick = function()
			{
				
				if(partie.possibles.indexOf(this.id*1) != -1)
				{
					window.location.href = 'coup.php?coup='+this.id;
				}
			}
			
			if(partie.possibles.indexOf(i) != -1)
			{
				butts[i].classList.add("flick");
			}
		}
	
	
	for(var i=0;i<9;i++)
	{
		if(partie.megagrille[i] > 0)
		{
			for(var j=0;j<9;j++)
			{
				butts[j+9*i].classList.add("win"+partie.megagrille[i]);
			}
		}
	}
	
	//lecture coups
	coups = partie.coups;
	
	for(var i = 0; i < coups.length; i++)
	{
		var id = coups[i];
		var player = 1+(i%2);
		grille[id] = player;
		drawCase(id,player);
	}
	
	
	var message = document.getElementById("message");
	
	if(partie.final == 0)
	{
	
		if((partie.first && partie.tour%2 == 0) || (!partie.first && partie.tour%2 == 1))//Tour du joueur
		{
			message.innerHTML = "C'est <span style='color:"+["blue","red"][partie.first*1]+"'>votre</span> tour !";
		}
		else // Tour de l'adversaire
		{
			message.innerHTML = "Au tour de <span style='color:"+["red","blue"][partie.first*1]+"'>"+partie.j2+"</span> !";
			autoRefresh();
		}
	}
	else if(partie.final == 3) // egalité
	{
		message.innerHTML = "Fin de la partie <br/> ÉGALITÉ";
	}
	else if((partie.first && partie.final == 1) || (!partie.first && partie.final == 2)) // victoire
	{
		message.innerHTML = "Fin de la partie <br/> Vous avez GAGNÉ !";
	}
	else // Défaite
	{
		message.innerHTML = "Fin de la partie <br/> Vous avez PERDU...";
	}
	
	
}

function click(id)
{
	// drawCase(id);
}

function drawCase(id,player)
{
	var el = butts[id];
	el.innerHTML = "";

	el.appendChild(getIcon(player));
}

function getIcon(player)
{
	var gl = document.createElement("span");
	
	if(player == 1)
	{
		gl.className = "glyphicon glyphicon-remove";
		gl.style.color = "red";
	}
	else
	{
		gl.className = "glyphicon glyphicon-ban-circle";
		gl.style.color = "blue";
	}
	
	return gl;
}


function autoRefresh()
{
	setTimeout(function(){
   // window.location.reload(1);
   window.location.href = 'partie.php?r='+(+new Date())+'#message';
}, 5000);
}


//<span class="glyphicon glyphicon-remove"></span>



init();