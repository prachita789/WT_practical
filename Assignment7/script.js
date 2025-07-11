let matchInterval;

function loadXML() {
  clearInterval(matchInterval);

  fetch('matchInfo.xml')
    .then(response => {
      if (!response.ok) throw new Error("XML fetch failed");
      return response.text();
    })
    .then(str => {
      const parser = new DOMParser();
      const xml = parser.parseFromString(str, "application/xml");

      const team1 = xml.getElementsByTagName("team1")[0].textContent;
      const team2 = xml.getElementsByTagName("team2")[0].textContent;
      const venue = xml.getElementsByTagName("venue")[0].textContent;

      const now = new Date();
      const formattedDate = now.toLocaleDateString();
      const formattedTime = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

      document.getElementById("teams").textContent = `${team1} vs ${team2}`;
      document.getElementById("venue").textContent = `Venue: ${venue}`;
      document.getElementById("dateTime").textContent = `Date: ${formattedDate}, Time: ${formattedTime}`;
      document.getElementById("scoreDisplay").textContent = "";
      document.getElementById("currentInning").textContent = "";
      document.getElementById("playersSection").style.display = "block";

      const indiaList = document.querySelector("#indiaPlayers ul");
      const nzList = document.querySelector("#nzPlayers ul");
      indiaList.innerHTML = "";
      nzList.innerHTML = "";

      const indiaPlayers = xml.querySelectorAll('team[name="India"] > player');
      const nzPlayers = xml.querySelectorAll('team[name="New Zealand"] > player');

      indiaPlayers.forEach(p => {
        const li = document.createElement("li");
        li.textContent = p.textContent;
        indiaList.appendChild(li);
      });

      nzPlayers.forEach(p => {
        const li = document.createElement("li");
        li.textContent = p.textContent;
        nzList.appendChild(li);
      });
    })
    .catch(error => {
      alert("Error loading XML: " + error.message);
    });
}

function loadJSON() {
  clearInterval(matchInterval);

  fetch("liveScore.json")
    .then(response => {
      if (!response.ok) throw new Error("JSON fetch failed");
      return response.json();
    })
    .then(data => {
      let team1 = { ...data.team1 };
      let team2 = { ...data.team2 };
      let inning = data.currentInning;

      document.getElementById("teams").textContent = `India VS New Zealand`;
      document.getElementById("venue").textContent = "";
      document.getElementById("dateTime").textContent = "";
      document.getElementById("playersSection").style.display = "none";

      function updateScoreDisplay() {
        document.getElementById("scoreDisplay").innerHTML = `
          <div><strong>India:</strong> ${team1.runs}/${team1.wickets} (${team1.overs.toFixed(1)} overs)</div>
          <div><strong>New Zealand:</strong> ${team2.runs}/${team2.wickets} (${team2.overs.toFixed(1)} overs)</div>
        `;
        document.getElementById("currentInning").textContent = `Status: ${inning}`;
      }

      updateScoreDisplay();

      matchInterval = setInterval(() => {
        if (inning === "India batting") {
          team1.runs += Math.floor(Math.random() * 7);
          team1.overs += 0.1;
          if (Math.random() < 0.1) team1.wickets++;
          if (team1.overs >= 20 || team1.wickets >= 10) {
            inning = "New Zealand batting";
            team1.overs = 20;
            team1.wickets = Math.min(team1.wickets, 10);
          }
        } else if (inning === "New Zealand batting") {
          team2.runs += Math.floor(Math.random() * 7);
          team2.overs += 0.1;
          if (Math.random() < 0.1) team2.wickets++;
          if (team2.overs >= 20 || team2.wickets >= 10) {
            inning = "Match Ended";
            clearInterval(matchInterval);
          }
        }

        if (team1.overs % 1 >= 0.6) team1.overs = Math.floor(team1.overs) + 1;
        if (team2.overs % 1 >= 0.6) team2.overs = Math.floor(team2.overs) + 1;

        updateScoreDisplay();
      }, 10000);
    })
    .catch(error => {
      alert("Error loading JSON: " + error.message);
    });
}
