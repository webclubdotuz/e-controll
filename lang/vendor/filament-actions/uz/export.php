<?php

return [
    "notifications" => [
        "started" => [
            "title" => "Export boshlandi", // Customize this text
            "body" => "Exportning yakunlanishini kuting...", // Customize this text
        ],
        "completed" => [
            "title" => "Export yakunlandi", // Customize this text
            "actions" => [
                "download_xlsx" => [
                    "label" => "XLSX-ni yuklab oling", // Customize this text
                ]
            ],
        ],
    ],
    "modal" => [
        "heading" => "Export :label", // Customize this text
        "form" => [
            "columns" => [
                "label" => "Choose Columns", // Customize this text
            ],
        ],
        "actions" => [
            "export" => [
                "label" => "Export", // Customize this text
            ],
            // filament-actions::export.notifications.completed.actions.download_xls
            "download_xls" => [
                "label" => "Download XLS", // Customize this text
            ],
        ],
    ],
];
