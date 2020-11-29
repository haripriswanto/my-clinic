

        // ************* LAPORAN PENJUALAN HARIAN ************* //
    
    $('#out_daily_report_date').change(function() {
        var in_daily_report_date  = $('#in_daily_report_date').val();
        var out_daily_report_date = $('#out_daily_report_date').val();

        if (out_daily_report_date != "") // jika value akhir tidak kosong-->
           {
            
            $("#daily_result").html("<img src='assets/images/load.gif' align='center' style='margin: 15px auto;' />Sabar Ya, Sedang Proses...");
            $('#daily_result').load('pages/report_transaction/daily-report.php?in_daily_report_date='+in_daily_report_date+'&out_daily_report_date='+out_daily_report_date);
        }
    });

        // ************* LAPORAN KELOMPOK PASIEN ************* //

    $('#tgl_emergency_group_akhir').change(function() {
        var patient_emergency_group_awal  = $('#tgl_emergency_group_awal').val();
        var patient_emergency_group_akhir = $('#tgl_emergency_group_akhir').val();

        if (patient_emergency_group_akhir != "") // jika value akhir tidak kosong-->
           {
            
            $("#patientEmergencyGroup_result").html("<img src='../images/load.gif' align='center' style='margin: 15px auto;' />Please Wait...");
            $('#patientEmergencyGroup_result').load('reportEmergency/reportEmergencyGroup.php?patient_emergency_group_awal='+patient_emergency_group_awal+'&patient_emergency_group_akhir='+patient_emergency_group_akhir);
    }
    }); 

        // ************* LAPORAN PENDAPATAN IGD ************* //

    $('#tgl_emergency_income_group_akhir').change(function() {
        var emergency_income_group_awal  = $('#tgl_emergency_income_group_awal').val();
        var emergency_income_group_akhir  = $('#tgl_emergency_income_group_akhir').val();

        if (emergency_income_group_akhir != "") // jika value akhir tidak kosong-->
           {
            
            $("#patient_emergency_income_group_result").html("<img src='../images/load.gif' align='center' style='margin: 15px auto;' />Please Wait...");
            $('#patient_emergency_income_group_result').load('reportEmergency/reportEmergencyIncomeGroup.php?emergency_income_group_awal='+emergency_income_group_awal+'&emergency_income_group_akhir='+emergency_income_group_akhir);
    }
    }); 
