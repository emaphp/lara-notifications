import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import FilePickerComponent from './components/FilePickerComponent';

if (document.getElementById('file-picker')){
    const filePickerEl = document.getElementById('file-picker');
    const userId = filePickerEl.getAttribute('user-id');
    ReactDOM.render(<FilePickerComponent pictureUrl = {'api.filePicker'} userId={userId}/>, filePickerEl);
}