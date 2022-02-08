const backBtn = document.getElementById('back');
const instr = document.getElementById('instr');
const instrBtn = document.getElementById('instructions');

instr.style.display = 'none';

instrBtn.onclick = function () {
    instr.style.display = 'block';
}

backBtn.onclick = function () {
    instr.style.display = 'none';
}

console.log('hey')