<!DOCTYPE html>
<html>

<head>
    <title>Pre-Admission Medical Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
        }

        .section-title {
            font-weight: bold;
            margin: 15px 0 5px;
            font-size: 16px;
            text-decoration: underline;
        }

        .form-field {
            margin-bottom: 10px;
        }

        .form-field label {
            display: inline-block;
            width: 200px;
            font-weight: bold;
        }

        .form-field span {
            display: inline-block;
            width: calc(100% - 210px);
            border-bottom: 1px solid #000;
            height: 1.2em;
        }

        .signature {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Bamidele Olumilua University of Education, Science and Technology, Ikere-Ekiti</h1>
    <p style="text-align: center;">Pre-Admission Medical Test</p>

    <p style="text-align: center;">IT SHOULD BE NOTED THAT THE MEDICAL TEST INCLUDING X - RAY WILL BE DONE ONLY AT THE UNIVERSITY
        HEALTH CENTRE AT A TOTAL COST STIPULATED BY THE UNIVERSITY. NO RESULTS OTHER THAN FROM THE
        UNIVERSITY HEALTH CENTER WILL BE ACCEPTED.</p>

    <div class="section-title">Section A: Bio-Data</div>
    <div class="form-field">
        <label>Full Name:</label>
        <span>{{ $user->name }}</span>
    </div>
    <div class="form-field">
        <label>Age (Last Birthday):</label>
        <span>{{ $user->age }}</span>
    </div>
    <div class="form-field">
        <label>Sex:</label>
        <span>{{ $user->gender }}</span>
    </div>
    <div class="form-field">
        <label>Marital Status:</label>
        <span>{{ $user->marital_status }}</span>
    </div>
    <div class="form-field">
        <label>Nationality:</label>
        <span>{{ $user->nationality }}</span>
    </div>
    <div class="form-field">
        <label>State of Origin:</label>
        <span>{{ $user->state_of_origin }}</span>
    </div>
    <div class="form-field">
        <label>State of Domicile:</label>
        <span>{{ $user->state_of_domicile }}</span>
    </div>
    <div class="form-field">
        <label>Faculty:</label>
        <span>{{ $user->faculty }}</span>
    </div>
    <div class="form-field">
        <label>Department:</label>
        <span>{{ $user->department }}</span>
    </div>
    <div class="form-field">
        <label>Phone No:</label>
        <span>{{ $user->phone }}</span>
    </div>

    <div class="section-title">Section B: Medical History</div>
    <div class="form-field">
        <label>Heart Disease:</label>
        <span>{{ $user->heart_disease ? 'Yes' : 'No' }}</span>
    </div>
    <div class="form-field">
        <label>Respiratory Disease:</label>
        <span>{{ $user->respiratory_disease ? 'Yes' : 'No' }}</span>
    </div>
    <div class="form-field">
        <label>Tuberculosis:</label>
        <span>{{ $user->tuberculosis ? 'Yes' : 'No' }}</span>
    </div>
    <div class="form-field">
        <label>Stomach Disorder:</label>
        <span>{{ $user->stomach_disorder ? 'Yes' : 'No' }}</span>
    </div>
    <div class="form-field">
        <label>Mental Disorder:</label>
        <span>{{ $user->mental_disorder ? 'Yes' : 'No' }}</span>
    </div>
    <div class="form-field">
        <label>Sickle Cell:</label>
        <span>{{ $user->sickle_cell ? 'Yes' : 'No' }}</span>
    </div>
    <div class="form-field">
        <label>Operations:</label>
        <span>{{ $user->previous_operations }}</span>
    </div>
    <div class="form-field">
        <label>Other Illnesses:</label>
        <span>{{ $user->other_illnesses }}</span>
    </div>

    <div class="section-title">Section C: Investigation Results</div>
    <div class="form-field">
        <label>Blood Pressure:</label>
        <span>{{ $user->vital_signs_bp }}</span>
    </div>
    <div class="form-field">
        <label>Respiratory Rate:</label>
        <span>{{ $user->vital_signs_rr }}</span>
    </div>
    <div class="form-field">
        <label>Pulse Rate:</label>
        <span>{{ $user->vital_signs_pr }}</span>
    </div>
    <div class="form-field">
        <label>HB Genotype:</label>
        <span>{{ $user->hb_genotype }}</span>
    </div>
    <div class="form-field">
        <label>Blood Group:</label>
        <span>{{ $user->blood_group }}</span>
    </div>
    <div class="form-field">
        <label>Chest X-Ray:</label>
        <span>{{ $user->chest_xray }}</span>
    </div>
    <div class="form-field">
        <label>Urine Analysis:</label>
        <span>{{ $user->urine_analysis }}</span>
    </div>
    <div class="form-field">
        <label>General Fitness:</label>
        <span>{{ $user->general_fitness }}</span>
    </div>

    <div class="signature">
        <p>Certified by: _________________________</p>
        <p>Signature: _________________________</p>
        <p>NOTE: PROSPECTIVE STUDENTS SHOULD COME TO THE HEALTH CENTRE FOR THE TEST AS SOON AS THEY SUBMIT
            THEIR ACCEPTANCE LETTERS.</p>
    </div>
</body>

</html>