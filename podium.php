<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CHAMPIONS</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Railway&family=Amatic+SC:wght@400;700&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --primary: #a5004d;
      --white: #f3f3f3;
    }

    body {
      height: 100vh;
      display: grid;
      place-items: center;
      font-family: "Railway", sans-serif;
      background-color: var(--white);
      background-image: url("https://www.transparenttextures.com/patterns/inspiration-geometry.png");
    }

    a {
      text-decoration: none;
    }

    ul {
      list-style: none;
    }

    .container {
      width: 100%;
      max-width: 600px;
      padding: 2em 0;
      display: grid;
      grid-template-rows: 400px 1fr;
      grid-column-gap: 1em;
      opacity: 0;
      animation: fadeIn 1.5s ease-in-out forwards;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    .leaders {
      background-color: var(--primary);
      background-image: url("https://www.transparenttextures.com/patterns/inspiration-geometry.png");
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      padding-top: 2em;
      display: grid;
      grid-template-rows: 20% 1fr;
      justify-items: center;
    }
    
    .leaders h2 {
      text-align: center;
      font-size: 3rem;
      font-weight: 700;
      padding-bottom: 40px;
      font-family: "Amatic SC", sans-serif;
      color: var(--white);
    }
    
    .leaders ul {
      width: 420px;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      align-items: flex-end;
      grid-gap: 10px;
    }

    .lead-cats {
      display: flex;
      flex-direction: column;
      justify-content: end;
    }
    
    .lead-cats__photo {
      width: 108px;
      margin: 0 auto;
    }

    .podium {
      padding: 1em;
      text-align: center;
      background-color: var(--white);
      height: 160px;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      position: relative;
    }
    
    .podium h4 {
      font-family: "Sofia", sans-serif;
      font-size: 1.8rem;
      text-shadow: 3px 3px 3px #ababab;
      color: var(--primary);
    }
    
    .podium p {
      color: rgb(255,255,255);
      margin: 5px 0;
      font-size: 0.9rem;
    }

    .pod-1 {
      height: 160px;
    }

    .pod-2 {
      height: 130px;
    }

    .pod-3 {
      height: 100px;
    }

    .board {
      display: none; /* Hide the leaderboard */
    }
  </style>
</head>
<body>

<div class="container" id="app">

  <div class="leaders">
    <h2>CONGRATES, CHAMPS!!</h2>
    <ul>
      <li v-for="(cat, i) in topThreeCats" :key="i">
        <div class="lead-cats">
          <img class="lead-cats__photo" :src="`https://www.sicontis.com/codepen/cpc-rising/${cat.photo}.svg`" :class="{ active: cat.name === newLeader }">
          <div class="podium" :class="`pod-${i + 1}`" :style="{ backgroundColor: cat.colour }">
            <h4>{{ getPlace(i) }}</h4>
            <p>{{ cat.points }} points</p>
          </div>
        </div>
      </li>
    </ul>
  </div>

  <div class="board">
    <h2>Leaderboard</h2>

    <transition-group name="slide" tag="ul" appear>
      <cat-list-item v-for="(cat, i) in allCats" :cat="cat" :rank="i" :key="cat.name">
      </cat-list-item>
    </transition-group>

  </div>
</div>

<template id="cat-list-item">
  <li class="cat-item">
    <div class="cat-item__photo">
      <div class="ranking" :style="{ backgroundColor: colorOrder }">{{ rankOrder }}</div>
      <img :src="`https://www.sicontis.com/codepen/cpc-rising/heads/${cat.photo}.svg`">
    </div>
    <div class="cat-item__info">
      <h4>{{ cat.name }}</h4>
    </div>
    <div class="cat-item__points">
      <img src="https://www.sicontis.com/codepen/cpc-rising/chevron.svg" @click="pointIncrement">
      <p>{{ cat.points }}</p>
      <img src="https://www.sicontis.com/codepen/cpc-rising/chevron.svg" @click="pointDecrement">
    </div>

  </li>
</template>

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script>
const CatListItem = Vue.component("cat-list-item", {
  template: "#cat-list-item",
  props: ["cat", "rank"],
  data() {
    return {
      colors: ["#d6cd1e", "#bbbbbb", "#d6a21e"]
    };
  },
  computed: {
    rankOrder: function () {
      return this.rank + 1;
    },
    colorOrder: function () {
      return this.colors[this.rank];
    }
  },
  methods: {
    pointIncrement: function () {
      this.cat.points++;
    },
    pointDecrement: function () {
      this.cat.points--;
    }
  }
});

new Vue({
  el: "#app",
  components: {
    CatListItem
  },
  data() {
    return {
      cats: [
        {
          name: "Milo",
          photo: "cat-1",
          colour: 'rgba(0, 255, 0, 0.7)',
          points: <?php echo isset($_GET['id1']) ? (int)$_GET['id1'] : 0; ?>
        },
        {
          name: "Polly",
          photo: "cat-4",
          colour: 'rgba(255, 165, 0, 0.7)',
          points: <?php echo isset($_GET['id2']) ? (int)$_GET['id2'] : 0; ?>
        },
        {
          name: "Baxter",
          photo: "cat-3",
          colour: 'rgba(0, 0, 255, 0.7)',
          points: <?php echo isset($_GET['id3']) ? (int)$_GET['id3'] : 0; ?>
        }
      ],
      catRank: [
        { r: 2, c: "#d6a21e" },
        { r: 0, c: "#d6cd1e" },
        { r: 1, c: "#bbbbbb" }
      ],
      newLeader: ""
    };
  },

  computed: {
    allCats: function () {
      return [...this.cats].sort((a, b) => b.points - a.points);
    },
    topThreeCats: function () {
      return [...this.cats]
        .sort((a, b) => b.points - a.points)
        .slice(0, 3);
    },
    leadCat() {
      return this.topThreeCats.map((cat) => cat.name);
    }
  },

  watch: {
    leadCat(newValue, oldValue) {
      if (newValue[1] !== oldValue[1]) {
        this.newLeader = newValue[1];
      } else {
        this.newLeader = "";
      }
    }
  },
  
  methods: {
    getPlace: function (index) {
      const places = ["1st", "2nd", "3rd"];
      return places[index];
    },
    // ... other methods
  }
});
</script>

</body>
</html>
