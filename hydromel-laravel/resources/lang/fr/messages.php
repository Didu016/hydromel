<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
return [
    'bd' => [
        'error' => 'Erreur technique : :error',
    ],
    'not_implemented' => "Cette fonctionnalité n'est pas encore implémentée.",
    'status' => [
        'success' => 'success',
        'error' => 'error'
    ],
    'edition' => [
        'exists' => "L'édition existe déjà",
        'saved' => "L'édition a bien été créé",
        'missing' => "L'édition spécifiée est introuvable.",
        'current' => [
            'missing' => "L'édition courante n'a pas pu être chargée."
        ],
        'previous' => [
            'missing' => "Les éditions précédentes n'ont pas pu être chargées"
        ]
    ],
    'article' => [
        'exists' => "L'article existe déjà",
        'saved' => "L'article a bien été créé",
        'missing' => "L'article spécifié est introuvable.",
        'unavailable' => "L'article spécifié est indisponible",
        'nb' => [
            'missing' => "Le numéro d'article n'a pas été spécifié",
            'unavailable' => "Cet article est indisponible"
        ]
    ],
    'commande' => [
        'missing' => "La commande spécifiée est introuvable."
    ],
    'ligne' => [
        'exists' => "Cette ligne de commande existe déjà",
        'saved' => "La ligne de commande a bien été enregistrée"
    ],
    'contrat' => [
        'saved' => "Le contrat a bien été créé",
        'missing' => "Le contrat spécifié est introuvable."
    ],
    'client' => [
        'missing' => "Le client spécifié est introuvable",
        'created' => "Le client a bien été créé"
    ],
    'commande' => [
        'created' => "La commande a bien été créée."
    ],
    'couverture' => [
        'saved' => "La couverture a bien été sauvée.",
        'date_error' => "La date du sinistre doit se trouver entre les dates de début et de fin du contrat qui couvre ce sinistre.",
        'exists' => "Cette couverture existe déjà"
    ],
    'implication' => [
        'saved' => "L'implication a bien été enregistrée.",
        'assure' => "Le contrat qui assure ce véhicule ne couvre pas ce sinistre.",
        'typecontrat' => "Pour que le véhicule soit impliqué dans un sinistre, il faut qu'il soit assuré par un contrat de type RC ou RC + Casco",
        'exists' => "Cette implication existe déjà"
    ],
    'vehicule' => [
        'missing' => "Le véhicule spécifié est introuvable."
    ]
];
