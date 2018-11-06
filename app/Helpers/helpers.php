<?php

/**
 * Return the number with the country code
 */
function phoneWithAreaCode($phone) {
    return '+549'.$phone;
}

/**
 * Set whatsapp prefix
 */
function whatsappPhone($phone) {
    return 'whatsapp:'.phoneWithAreaCode($phone);
}