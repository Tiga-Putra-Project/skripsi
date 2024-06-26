/*
Template Name: StarCode & Dashboard Template
Author: StarCode Kh
Version: 1.1.0
Website: https://StarCode Kh.in/
Contact: StarCode Kh@gmail.com
File: apps ecommerce product grid init Js File
*/

const listView = document.getElementById("listView");
const gridView = document.getElementById("gridView");
const cardGridView = document.getElementById("cardGridView");

listView.addEventListener("click", toggleListView);
gridView.addEventListener("click", toggleGridView);

function toggleListView() {
    if (!listView.classList.contains('active')) {
        listView.classList.add("active");
    }
    cardGridView.classList.add("gridView");
    if (gridView.classList.contains('active')) {
        gridView.classList.remove("active");
    }
}

function toggleGridView() {
    if (listView.classList.contains('active')) {
        listView.classList.remove("active");
    }
    if (!gridView.classList.contains('active')) {
        gridView.classList.add("active");
    }
    gridView.classList.add("active");
    cardGridView.classList.remove("gridView");
}