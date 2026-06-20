async function loadSummary() {

    const response = await fetch(
        'api/dashboard/get_summary.php'
    );

    const data = await response.json();

    document.getElementById('awaitingApproval').innerText =
        data.awaitingApproval;

    document.getElementById('delayedParts').innerText =
        data.delayedParts;

    document.getElementById('readyPickup').innerText =
        data.readyPickup;
}

async function loadBays() {

    const response = await fetch(
        'api/dashboard/get_bays.php'
    );

    const data = await response.json();

    document.getElementById('waitingApprovalColumn').innerHTML = '';

    document.getElementById('diagnosticsColumn').innerHTML = '';

    document.getElementById('progressColumn').innerHTML = '';

    document.getElementById('partsColumn').innerHTML = '';

    document.getElementById('pickupColumn').innerHTML = '';

    data.forEach(order => {

        const card = `

<div class="repair-card">

    <div class="card-top">

        <span class="status-badge">
            ${order.priority || 'PENDING'}
        </span>

        <span class="card-menu">⋮</span>

    </div>

    <img
        src="assets/images/vehicles/${order.vehicle_image}"
        class="vehicle-image"
    >

    <h4>${order.vehicle_name}</h4>

    <p>Tech: ${order.technician}</p>

    ${
        order.progress > 0
        ?
        `
        <div class="progress-wrapper">

            <div class="progress-bar">

                <div
                    class="progress-fill"
                    style="width:${order.progress}%"
                ></div>

            </div>

            <small>${order.progress}%</small>

        </div>
        `
        :
        `
        <small>
            ⏱️ ${order.hours_open} hrs open
        </small>
        `
    }

    <button>
        View RO
    </button>

</div>
`;

        if(order.status === 'Waiting Approval') {

            document.getElementById(
                'waitingApprovalColumn'
            ).innerHTML += card;
        }

        if(order.status === 'Diagnostics') {

            document.getElementById(
                'diagnosticsColumn'
            ).innerHTML += card;
        }

        if(order.status === 'In Progress') {

            document.getElementById(
                'progressColumn'
            ).innerHTML += card;
        }

        if(order.status === 'Awaiting Parts') {

            document.getElementById(
                'partsColumn'
            ).innerHTML += card;
        }

        if(order.status === 'Ready Pickup') {

            document.getElementById(
                'pickupColumn'
            ).innerHTML += card;
        }
    });
}

loadSummary();

loadBays();

loadAlerts();

loadStaff();

setInterval(() => {

    if(autoRefresh) {

        loadSummary();

        loadBays();

        loadAlerts();

        loadStaff();
    }

}, 5000);

async function loadAlerts() {

    const response = await fetch(
        'api/dashboard/get_alerts.php'
    );

    const alerts = await response.json();

    let html = '';

    alerts.forEach(alert => {

        html += `

        <div class="side-alert">

            <p>${alert.message}</p>

            <small>Received 4 hours ago</small>

        </div>
        `;
    });

    document.getElementById(
        'alertsContainer'
    ).innerHTML = html;
}
async function loadStaff() {

    const response = await fetch(
        'api/dashboard/get_staff.php'
    );

    const staff = await response.json();

    let html = '';

    staff.forEach(member => {

        html += `

        <div class="staff-item">

            <div class="staff-left">

                <img
                    src="assets/images/technicians/${member.profile_image}"
                    class="staff-avatar"
                >

                <span>${member.full_name}</span>

            </div>

            <div class="staff-left">

                <div class="
                    status-dot
                    ${
                        member.status === 'Active'
                        ? 'active'
                        : 'off'
                    }
                "></div>

                <small>${member.status}</small>

            </div>

        </div>
        `;
    });

    document.getElementById(
        'staffContainer'
    ).innerHTML = html;
}